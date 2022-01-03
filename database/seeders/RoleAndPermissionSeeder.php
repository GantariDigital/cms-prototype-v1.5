<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Helpers\RolesData;
use Illuminate\Support\Arr;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::create([
            'name' => 'Admin 1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $arrayOfPermissionNames = [
            'pengajuan-dana view',
            'pengajuan-dana add', 
            'pengajuan-dana delete',
            'realisasi-dana view',
            'realisasi-dana add', 
            'realisasi-dana delete',
            'jurnal-harian view', 
            'jurnal-harian add', 
            'jurnal-harian delete',
            'progress-keuangan view', 
            'progress-keuangan add', 
            'progress-keuangan delete', 
            'aset-perusahaan view',
            'item-aset-perusahaan add',
            'item-aset-perusahaan delete',
            'inventori-perusahaan view',
            'inventori-perusahaan add',
            'inventori-perusahaan delete',
            'laporan-kegiatan view',
            'laporan-kegiatan add',
            'laporan-kegiatan delete',
            'legalitas-perusahaan view',
            'item-legalitas-perusahaan add',
            'item-legalitas-perusahaan delete',
            'sdm-perusahaan view',
            'sdm-perusahaan add',
            'sdm-perusahaan delete',
            'marketing view',
            'item-marketing add',
            'item-marketing delete',
            'laporan-harian view',
            'laporan-harian add',
            'laporan-harian delete',
            'progress-kemajuan view',
            'item-progress-kemajuan add',
            'item-progress-kemajuan delete',
            'photo-kegiatan view',
            'photo-kegiatan add',
            'photo-kegiatan delete',
            'control-stock view',
            'control-stock add',
            'control-stock delete',
            'resume-kegiatan view',
            'resume-kegiatan add',
            'resume-kegiatan delete',
            'perjanjian-kontrak view',
            'perjanjian-kontrak add',
            'perjanjian-kontrak delete',

            'financial-analysis view',
            'financial-analysis add',
            'financial-analysis delete',
            'gambar-unit-rumah view',
            'gambar-unit-rumah add',
            'gambar-unit-rumah delete',
            'konstruksi-unit-rumah view',
            'konstruksi-unit-rumah add',
            'konstruksi-unit-rumah delete',
            'item-unit-rumah view',
            'item-unit-rumah add',
            'item-unit-rumah delete',
            'konstruksi-sarana view',
            'item-konstruksi-sarana add',
            'item-konstruksi-sarana delete',
            'brosur-perumahan view',
            'brosur-perumahan add',
            'brosur-perumahan delete',

            'filter-data-masuk divisi-keuangan view',
            'filter-data-masuk divisi-konstruksi view',
            'filter-data-masuk divisi-marketing view',
            'filter-data-masuk divisi-umum view',
            'filter-data-masuk perencanaan view',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        $permission_view = collect($arrayOfPermissionNames)->map(function ($permission) {
            if(stripos($permission, "view")) {
                return ['name' => $permission, 'guard_name' => 'otp_user'];
            }
        });
        $otp_permissions = array_values(array_filter($permission_view->toArray()));

        $admin_permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'admin'];
        });
    
        Permission::insert($permissions->toArray());
        Permission::insert($otp_permissions);
        Permission::insert($admin_permissions->toArray());
        $list_permission = Permission::where([['guard_name', '=', 'admin']])->get();
        // dd($list_permission);
        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $role->syncPermissions($list_permission);
        
        $divisis = ['Keuangan', 'Konstruksi', 'Marketing', 'Umum'];

        foreach ($divisis as $key => $divisi) {
            $permission = RolesData::getAllPermissionByDivision($divisi);
            $permission_view = collect($permission)->filter(function($value, $index) {
                return false !== stripos($value, "view");
            });
            $permission_perencanaan = RolesData::getMenus('Perencanaan');
            $permission_perencanaan_view = collect($permission_perencanaan)->filter(function($value, $index) {
                return false !== stripos($value, "view");
            });
            $list_permission_view = Permission::query()
            ->where('guard_name', 'web')
            ->whereIn('name', Arr::collapse([$permission_view, $permission_perencanaan_view]))
            ->get();
            $list_permission_otp_view = Permission::query()
            ->where('guard_name', 'otp_user')
            ->whereIn('name', Arr::collapse([$permission_view, $permission_perencanaan_view]))
            ->get();

            $list_permission_staff = Permission::query()
            ->where('guard_name', 'web')
            ->whereIn('name', Arr::collapse([$permission, $permission_perencanaan_view]))
            ->get();

            $role = Role::create(['name' => "Divisi {$divisi} [VIEW ONLY]", 'guard_name' => 'web']);
            $role->syncPermissions($list_permission_view);

            $role_otp = Role::create(['name' => "Divisi {$divisi} [VIEW ONLY]", 'guard_name' => 'otp_user']);
            $role_otp->syncPermissions($list_permission_otp_view);

            $role_staff = Role::create(['name' => "Divisi {$divisi} [STAFF]", 'guard_name' => 'web']);
            $role_staff->syncPermissions($list_permission_staff);
        }

        $menus = ['Perencanaan', 'Pelaksanaan'];

        $all_view_permissions = [];
        $all_view_otp_permissions = [];

        foreach ($menus as $key => $menu) {
            $permission = RolesData::getMenus($menu);
            $permission_view = collect($permission)->filter(function($value, $index) {
                return false !== stripos($value, "view");
            });
            $list_permission = Permission::query()
            ->where('guard_name', 'web')
            ->whereIn('name', $permission_view)
            ->get();
            $list_otp_permission = Permission::query()
            ->where('guard_name', 'otp_user')
            ->whereIn('name', $permission_view)
            ->get();
            $all_view_permissions[] = $list_permission;
            $all_view_otp_permissions[] = $list_otp_permission;
            if($menu == "Pelaksanaan") {
                $list_permission_staff = Permission::query()
                ->where('guard_name', 'web')
                ->whereIn('name', Arr::collapse([ $permission, $all_view_permissions[0]->pluck('name')->toArray() ]))
                ->get();
                $role = Role::create(['name' => "Menu {$menu} [STAFF]", 'guard_name' => 'web']);
                $role->syncPermissions($list_permission_staff);
            }
        }

        $all_view_permissions = Arr::collapse($all_view_permissions);
        $role = Role::create(['name' => "Menu All [VIEW ONLY]", 'guard_name' => 'web']);
        $role->syncPermissions($all_view_permissions);

        $all_view_otp_permissions = Arr::collapse($all_view_otp_permissions);
        $role = Role::create(['name' => "Menu All [VIEW ONLY]", 'guard_name' => 'otp_user']);
        $role->syncPermissions($all_view_otp_permissions);

        $permission = RolesData::getMenus("Manage");
        $list_permission = Permission::query()
        ->where('guard_name', 'web')
        ->whereIn('name', $permission)
        ->get();
        $role = Role::create(['name' => "Manage Data Masuk [STAFF]", 'guard_name' => 'web']);
        $role->syncPermissions($list_permission);

        // $list_permission = Permission::whereIn('name', $role_keuangan)->get();
        // $list_permission = Permission::where([['guard_name', '=', 'admin']])->get();
        // $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        // $role->syncPermissions($list_permission);
        // $user->givePermissionTo([$arrayOfPermissionNames]);
        // $user->assignRole(['jurnal harian']);

        // dump('user has permission [jurnal-harian view]: '.$user->hasPermissionTo('jurnal-harian view'));
        // dump('user has permission [jurnal-harian add]: '.$user->hasPermissionTo('jurnal-harian add'));
        // dump('user has permission [jurnal-harian delete]: '.$user->hasPermissionTo('jurnal-harian delete'));
    }
}
