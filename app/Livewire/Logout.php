<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        // Redirect without returning a view
        $this->redirect(route('login'), navigate: true);
    }

    public function minted()
    {
        // Perform any necessary setup or checks here
        dd('Logout component mounted');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
