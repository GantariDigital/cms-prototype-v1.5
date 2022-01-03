<?php

namespace App\Http\Livewire\Landing;

use Livewire\Component;

class LvLandingPage extends Component
{
    public function render()
    {
        $data = [];
        return view('livewire.landing.lv-landing-page')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
