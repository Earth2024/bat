<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')
         ->extends('layouts.user')
        ->section('title')
        ->section('content');
    }
}
