<?php

namespace App\Http\Livewire\Pelaksanaan\Umum;

use Livewire\Component;
use App\Models\{
    Umum\LegalitasPerusahaan,
};
use App\Helpers\Converter;

class LvLegalitasPerusahaan extends Component
{
    public $menu_name = 'legalitas-perusahaan';

    public function render()
    {
        $data['items'] = LegalitasPerusahaan::all();

        $data['converter_class'] = Converter::class;

        return view('livewire.pelaksanaan.umum.lv-legalitas-perusahaan')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
