<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationAccountController extends Controller
{
    public function create(){
        return view('backend.evaluation.create-evaluation');
    }
}
