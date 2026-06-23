<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        // A lógica de renderização agora fica limpa e sem erros no IDE
        return view('livewire.admin.dashboard');
    }
}
