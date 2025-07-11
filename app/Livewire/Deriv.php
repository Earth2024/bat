<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Deriv extends Component
{

    public function initiateOAuth() {
        $clientId = env('DERIV_CLIENT_ID');
        $redirectUri = env('DERIV_REDIRECT_URI');
        $authUrl = "https://oauth.deriv.com/authorize?client_id={$clientId}&response_type=token&redirect_uri={$redirectUri}";

        //$this->dispatchBrowserEvent('openOAuthPopup', ['url' => $authUrl]);
        $this->dispatch('openOAuthPopup', ['url' => $authUrl]);

    }

    public function render()
    {
        return view('livewire.deriv');
    }
}
