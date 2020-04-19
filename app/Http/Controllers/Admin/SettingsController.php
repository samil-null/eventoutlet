<?php

namespace App\Http\Controllers\Admin;

use Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function store(Request $request)
    {

        if (is_array($request->settings)) {
            foreach ($request->settings as $key => $value) {
                Setting::set($key, $value);
            }
        }

        Setting::save();

        return redirect()->route('admin.settings.index');

    }
}
