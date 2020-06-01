<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings', [
            'user' => Auth::user(),
        ]);
    }

    public function update(SettingsUpdateRequest $request)
    {
        Auth::user()->update([
            'todoist_disable_reminders' => (bool) $request->get('todoist_disable_reminders'),
            'google_reminders' => $request->get('google_reminders'),
        ]);

        return redirect()->back();
    }

    public function toggle()
    {
        Auth::user()->update([
            'sync_enabled' => !Auth::user()->sync_enabled,
        ]);

        return redirect()->back();
    }
}
