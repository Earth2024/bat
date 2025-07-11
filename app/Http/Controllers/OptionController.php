<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    public function index(){
        return view('backend.option.index');
    }

    public function test(){
        return view('test2');
    }

    public function place(Request $request){
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.5|max:10000',
            'contractType' => 'required|in:CALL,PUT',
        ]);

        $user = Auth::user();
        $account = $user->account->optionAccount;

        // Check balance
        if ($account->balance < $validated['amount']) {
            return response()->json(['error' => 'Insufficient balance.'], 403);
        }

        // Immediately charge the user
        $account->decrement('balance', $validated['amount']);

        // Send trade data back to JS (to pass to Deriv)
        return response()->json([
            'status' => 'ok',
            'trade' => [
                'amount' => (double) $validated['amount'],
                'contractType' => (string) $validated['contractType'],
                //'user_id' => $user->id,
            ],
        ]);
    }

}


