<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasActiveBotKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $activeBotKey = $user->bots()->where('status', 'active')->first();

        if (!$activeBotKey) {
            return redirect()->back()->with('error', 'You must activate a bot key to use your bot.');
            //return redirect()->route('bot.locked')->with('error', 'You must activate a bot key to use your bot.');
        }

        // Optionally attach the active key to the request or session
        //$request->merge(['active_bot' => $activeBotKey]);

        return $next($request);

    }
}
