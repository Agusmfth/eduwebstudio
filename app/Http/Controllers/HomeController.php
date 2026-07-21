<?php
namespace App\Http\Controllers;

use App\Models\ContentItem;
use App\Models\Setting;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index()
    {
        $items = ContentItem::where('is_active', true)->orderBy('sort_order')->get()->groupBy('section');
        $settings = Setting::pluck('value', 'key');
        return view('home', compact('items', 'settings'));
    }

    public function demo(ContentItem $contentItem)
    {
        abort_unless($contentItem->section === 'portfolio' && $contentItem->is_active, 404);
        return view('portfolio-demo', ['project' => $contentItem, 'settings' => Setting::pluck('value', 'key')]);
    }
}
