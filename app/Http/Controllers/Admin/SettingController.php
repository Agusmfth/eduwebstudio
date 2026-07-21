<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit() { return view('admin.settings', ['settings' => Setting::pluck('value','key')]); }
    public function update(Request $request)
    {
        $data = $request->validate([
            'brand' => ['required','string','max:100'], 'hero_badge' => ['required','string','max:120'],
            'hero_title' => ['required','string','max:255'], 'hero_text' => ['required','string','max:1000'],
            'whatsapp' => ['required','string','max:30'], 'whatsapp_secondary' => ['nullable','string','max:30'], 'email' => ['required','email','max:150'],
            'address' => ['required','string','max:255'], 'cta_title' => ['required','string','max:255'],
            'cta_text' => ['required','string','max:500'],
        ]);
        foreach ($data as $key => $value) Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
