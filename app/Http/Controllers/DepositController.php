<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function deposit(){
        return view('backend.deposit.fund');
    }
}
