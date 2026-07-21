<?php
namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        Inquiry::create($request->validate([
            'name' => ['required','string','max:100'], 'school' => ['nullable','string','max:150'],
            'phone' => ['required','string','max:30'], 'email' => ['nullable','email','max:150'],
            'message' => ['required','string','max:2000'],
        ]));
        return back()->with('success', 'Terima kasih! Pesan konsultasi Anda sudah kami terima.');
    }
}
