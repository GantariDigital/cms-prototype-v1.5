<?php

namespace App\Http\Livewire\Pelaksanaan\Konstruksi;

use Livewire\Component;
use App\Models\{
    Konstruksi\ProgressKemajuan,
};
use App\Helpers\Converter;

class LvProgressKemajuan extends Component
{
    public $menu_name = 'progress-kemajuan';

    public function render()
    {
        $data['items'] = ProgressKemajuan::all();

        $data['converter_class'] = Converter::class;

        return view('livewire.pelaksanaan.konstruksi.lv-progress-kemajuan')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
