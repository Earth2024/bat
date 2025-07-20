<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Password extends Component
{
    public $new_password; 
    public $current_password; 
    public $new_password_confirmation; 

    public function updatePassword(){
        $this->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:100', 'confirmed'],
        ]);

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            
            return back()->with(['password_error' => 'Current password is incorrect']);
        }

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);
        return back()->with(['password' => 'Password updated successfully']);
    }

    public function render()
    {
        return view('livewire.profile.password');
    }
}
