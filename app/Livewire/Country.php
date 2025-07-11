<?php

namespace App\Livewire;

use App\Models\Country as Countries;
use Livewire\Component;


class Country extends Component
{
    public $countries;
    public $selectedCountry = null;
    public $selectedCountryName = null;

    
    public function render()
    {
        $this->countries = Countries::limit(5)->pluck('name', 'id')->toArray();
        return view('livewire.country');
    }
}

