<?php

namespace App\Livewire\Kyc;

use App\Models\Kyc;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $phone; 
    public $address_1; 
    public $address_2; 
    public $city; 
    public $state; 
    public $country; 
    public $id_type; 
    public $id_number;
    public $postal_code;
    public $id_img;
    public $utility_type;
    public $utility_img;
    public $selfie_img;

    public $showIndex = true;
    public $showId = false;
    public $showUtility = false;
    public $showSelfie = false;

    public function showIdForm(){
        $this->showId = true;
        $this->showIndex = false;
        $this->showUtility = false;
        $this->showSelfie = false;
    }

    public function showUtilityForm(){
        $this->showId = false;
        $this->showIndex = false;
        $this->showUtility = true;
        $this->showSelfie = false;
    }

    public function showSelfieForm(){
        $this->showId = false;
        $this->showIndex = false;
        $this->showUtility = false;
        $this->showSelfie = true;
    }

    public function backTo(){
        $this->showId = false;
        $this->showIndex = true;
        $this->showUtility = false;
        $this->showSelfie = false;
    }

    public function storeIdentity(){
        $this->validate([
            'phone' => 'required|string',
            'address_1' => 'required|string|min:3|max:1000',
            'address_2' => 'nullable|string|min:3|max:1000',
            'city' => 'required|string|max:225',
            'state' => 'required|string|max:225',
            'country' => 'required|string|max:225',
            'id_img' => 'required|image|max:1024',
            'id_type' => 'required',
            'id_number' => 'required|min:5|max:21',
            'postal_code' => 'required',
        ]);
        $path = $this->id_img->store('public/id_images');

        // Example: Save to database
        $data = [
            'phone' => $this->phone,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'id_img' => $path,
            'postal_code' => $this->postal_code,
            'id_status' => 'Pending',
            'id_type' => $this->id_type,
            'id_number' => $this->id_number,
        ];

        $kycUpdate = auth()->user()->kyc;
        if($kycUpdate){
            $kycUpdate->update($data);
            $this->reset();
            return back()->with('id_success', 'Details updated successfully!');
        }else{
            $data['user_id'] = auth()->user()->id;
            Kyc::create($data);
            $this->reset(); // Clears form after submission
            return redirect()->back()->with('id_success', 'Details submitted successfully!');
        }
        
    }

    public function storeUtility(){
        
        $this->validate([
            'utility_img' => 'required|image|min:10|max:1024',
            'utility_type' => 'required',
        ]);
        $path = $this->utility_img->store('public/utility_images');

        // Example: Save to database
        $data = [
            'utility_status' => 'Pending',
            'utility_type' => $this->id_type,
            'utility_img' => $path,
        ];

        $kycUpdate = auth()->user()->kyc;
        if($kycUpdate){
            $kycUpdate->update($data);
            $this->reset();
            return back()->with('id_success', 'Details updated successfully!');
        }else{
            $data['user_id'] = auth()->user()->id;
            Kyc::create($data);
            $this->reset(); // Clears form after submission
            return redirect()->back()->with('id_success', 'Details submitted successfully!');
        }
        
    }

    public function render()
    {
        return view('livewire.kyc.index');
    }
}
