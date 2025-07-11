<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function create(){
        return view('backend.bot.bot');
    }

    public function store(Request $request){
        $request->validate([
            'botKey' => 'required|string|size:24',
        ]);

        try {
            $bot = auth()->user()->bots()->where('botKey', $request->botKey)->where('status', 'active')->first();
            if($bot !== null){
                if(Carbon::parse($bot->expires_at) > Carbon::now()){
                    return redirect()->route('bot.dashboard');
                }else{
                    return redirect()->back()->with('error', 'Your key has expired, please purchase a new key. Thank you');
                }
            }else{
                return redirect()->back()->with('error', 'Invalid key, please purchase a new key. Thank you');
            }
            
        } catch (\Throwable $th) {
            // Optional: Log the error
            \Log::error('login bot processing error: ' . $th->getMessage(), [
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'trace' => $th->getTraceAsString()
            ]);
            // Optional: Show generic error to user
            session()->flash('error', 'An unexpected error occurred while trying to login. Please try again later.');
        }
    }

    public function dashboard(){
        return view('backend.bot.dashboard');
    }

}
