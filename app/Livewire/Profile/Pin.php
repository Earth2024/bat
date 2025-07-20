<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Pin extends Component
{
    public $new_pin; 
    public $current_pin; 
    public $new_pin_confirmation; 

    public function updatePin(){
        
        $this->validate([
            'current_pin' => ['required'],
            'new_pin' => ['required', 'digits:4', 'confirmed'],
        ]);

        if (!Hash::check((int) $this->current_pin, auth()->user()->account->pin->pin)) {
            
            return back()->with(['pin_error' => 'Current pin is incorrect']);
        }

        auth()->user()->account->pin->update([
            'pin' => Hash::make($this->new_pin),
        ]);
        return back()->with(['pin' => 'Pin updated successfully']);
    }
    public function render()
    {
        return view('livewire.profile.pin');
    }
}
