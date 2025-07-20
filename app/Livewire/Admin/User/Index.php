<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $showUser = true;
    public $editUser = false;
    public $createUser = false;
    public $users;
    public $error;
    public $email;
    public $firstName;
    public $lastName;
    public $password;
    public $password_confirmation;
    public $id;
  

    public function createUserForm(){
        $this->showUser = false;
        $this->editUser = false;
        $this->createUser = true;
    }

    public function BackTo(){
        $this->showUser = true;
        $this->editUser = false;
        $this->createUser = false;
    }

    public function editUserForm($id){
        $this->showUser = false;
        $this->editUser = true;
        $this->createUser = false;
        $user = User::find($id);
        $this->email = $user->email;
        $this->id = $id;
    }

    public function updateUser(){

        $this->showUser = true;
        $this->editUser = false;
        $this->createUser = false;

        $this->validate([
            'password' => 'required|string|min:8|max:100|confirmed',
        ]);
        User::find($this->id)->update([
            'password' => Hash::make($this->password),
        ]);
        return back()->with('success', 'User password updated successfully');
    }

    public function registerUser(){
        $this->showUser = true;
        $this->editUser = false;
        $this->createUser = false;

        $this->validate([
            'email' => 'required|email|string|min:8|max:225|unique:users',
            'firstName' => 'required|string|min:2|max:225',
            'lastName' => 'required|string|min:2|max:225',
            'password' => 'required|string|min:8|max:100|confirmed',
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'country' => 'Nigeria',
            'role' => 'admin',
        ]);

        if($user){
            $this->reset();
            return back()->with('success', 'User created successfully');
        }


    }


    public function render()
    {
        $this->users = User::all();
        return view('livewire.admin.user.index');
    }
}
