<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use App\Models\{
    Perencanaan\KonstruksiUnitRumah,
};
use App\Helpers\Converter;

class LvKonstruksiUnitRumah extends Component
{
    public $menu_name = 'konstruksi-unit-rumah';

    public function render()
    {
        $data['items'] = KonstruksiUnitRumah::query()
        ->select('id', 'name', 'slug_name')
        ->get();

        $data['converter_class'] = Converter::class;

        return view('livewire.perencanaan.lv-konstruksi-unit-rumah')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
