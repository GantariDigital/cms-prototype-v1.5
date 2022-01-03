<?php

namespace App\Http\Livewire\Manage\DataMasuk;

use Livewire\Component;

class LvDataMasuk extends Component
{
    public function render()
    {
        $data = [];
        return view('livewire.manage.data-masuk.lv-data-masuk')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
