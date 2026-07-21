<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public const SECTIONS = [
        'services' => 'Layanan', 'portfolio' => 'Portofolio', 'features' => 'Keunggulan',
        'process' => 'Proses Kerja', 'pricing' => 'Paket Harga', 'testimonials' => 'Testimoni', 'faqs' => 'FAQ'
    ];

    public function index(string $section)
    {
        abort_unless(isset(self::SECTIONS[$section]), 404);
        $records = ContentItem::where('section', $section)->orderBy('sort_order')->get();
        return view('admin.content', ['records' => $records, 'section' => $section, 'label' => self::SECTIONS[$section]]);
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'], 'subtitle' => ['nullable','string','max:255'],
            'description' => ['nullable','string','max:3000'], 'icon' => ['nullable','string','max:20'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
            'project_url' => ['nullable','url','max:500'],
            'price' => ['nullable','string','max:100'], 'features' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0'], 'is_active' => ['nullable','boolean'],
        ]);
        $data['meta'] = ['features' => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $data['features'] ?? ''))))];
        unset($data['features'], $data['image']);
        if ($request->hasFile('image')) $data['image_path'] = $request->file('image')->store('portfolio', 'public');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }

    public function store(Request $request, string $section)
    {
        abort_unless(isset(self::SECTIONS[$section]), 404);
        ContentItem::create(['section' => $section] + $this->validated($request));
        return back()->with('success', 'Konten berhasil ditambahkan.');
    }

    public function update(Request $request, string $section, ContentItem $contentItem)
    {
        abort_unless($contentItem->section === $section, 404);
        $data = $this->validated($request);
        if (isset($data['image_path']) && $contentItem->image_path) Storage::disk('public')->delete($contentItem->image_path);
        $contentItem->update($data);
        return back()->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(string $section, ContentItem $contentItem)
    {
        abort_unless($contentItem->section === $section, 404);
        if ($contentItem->image_path) Storage::disk('public')->delete($contentItem->image_path);
        $contentItem->delete();
        return back()->with('success', 'Konten berhasil dihapus.');
    }
}
