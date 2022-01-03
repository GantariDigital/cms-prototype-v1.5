<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\{
    Guards\OtpUser,
};
use App\Helpers\{
    StringGenerator,
};
use DB;

class LvOtpUser extends Component
{
    protected $listeners = [
        'evSetItem' => 'setItem',
    ];

    public $select_wrapper = [
        'role_id' => null,
    ];

    public $selected_role_id;
    public ?OtpUser $selected_otp_user;

    public function render()
    {
        $data['otp_users'] = OtpUser::with('roles')->get();
        $data['roles'] = Role::query()
        ->where('guard_name', 'otp_user')
        ->get();

        return view('livewire.master.lv-otp-user')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function setItem($key, $id)
    {
        if(isset($this->select_wrapper[$key]) || array_key_exists($key, $this->select_wrapper)) {
            $this->select_wrapper[$key] = $id;
        }
    }

    public function setUser($id)
    {
        $user = OtpUser::findOrFail($id);
        
        $this->selected_otp_user = $user;
        if (!empty($user->roles[0])) {
            $this->selected_role_id = $user->roles[0]->id;
            return $this->dispatchBrowserEvent('select2:set', ['selector' => '#select_role', 'value' => $user->roles[0]->id]);
        }
    }

    public function addUser()
    {
        $create = OtpUser::create([
            'token' => StringGenerator::token(50),
            'access_code' => StringGenerator::hashId(6),
        ]);
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }

    public function updateUserRole()
    {
        $user = OtpUser::findOrFail($this->selected_otp_user->id);
        $role = Role::where('id', $this->select_wrapper['role_id'])->get();
        $user->syncRoles($role);
        
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully updating data.']);
    }

    public function resetInput()
    {
        $this->selected_otp_user = null;
        $this->reset('select_wrapper');
        $this->dispatchBrowserEvent('select2:set', ['selector' => '#select_role', 'value' => ""]);
    }

    public function removeRole($id)
    {
        $user = OtpUser::findOrFail($id);
        $user->syncRoles([]);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully updating data.']);
    }

    public function deleteUser($id)
    {
        $user = OtpUser::findOrFail($id);
        $user->delete();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully deleting data.']);
    }
}
