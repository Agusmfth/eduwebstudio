<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use App\Models\Inquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = ContentItem::selectRaw('section, count(*) total')->groupBy('section')->pluck('total', 'section');
        $latest = Inquiry::latest()->take(5)->get();
        return view('admin.dashboard', compact('counts', 'latest'));
    }
    public function inquiries() { return view('admin.inquiries', ['inquiries' => Inquiry::latest()->paginate(15)]); }
    public function read(Inquiry $inquiry) { $inquiry->update(['is_read' => true]); return back()->with('success', 'Pesan ditandai sudah dibaca.'); }
    public function destroyInquiry(Inquiry $inquiry) { $inquiry->delete(); return back()->with('success', 'Pesan berhasil dihapus.'); }
}
