<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/reminders'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent select_account'])
            ->redirect();
    }

    public function redirectTodoist()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        return Socialite::driver('todoist')
            ->scopes(['data:read_write'])
            ->redirect();
    }

    public function handleTodoist()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $user = Socialite::driver('todoist')->user();

        Auth::user()->update([
            'todoist_id' => $user->id,
            'todoist_access_token' => $user->token,
            'timezone' => $user->user['tz_info']['timezone'] ?? 'UTC',
        ]);

        return redirect()->route('settings');
    }


    public function handleGoogle()
    {
        /** @var \Laravel\Socialite\Two\User $user */
        $user = Socialite::driver('google')->user();

        $localUser = User::updateOrCreate(
            ['email' => $user->email],
            [
                'name' => $user->name,
                'google_id' => $user->id,
                'google_access_token' => $user->token,
                'google_access_token_expires_at' => Carbon::now()->addSeconds($user->expiresIn)->subSeconds(30),
                'google_refresh_token' => $user->refreshToken,

            ]
        );

        auth()->login($localUser, true);

        return redirect()->route('settings');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
