<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Fetch all settings so we can loop through them in the view
        $settings = Settings::all();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // We expect an array of settings: ['key' => 'value']
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Settings::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
