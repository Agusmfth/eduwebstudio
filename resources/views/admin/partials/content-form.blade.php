<div class="form-grid" style="margin-top:20px">
    <div class="field full"><label>Judul *</label><input name="title" required value="{{ old('title',$item?->title) }}"></div>
    <div class="field"><label>Label / Subjudul</label><input name="subtitle" value="{{ old('subtitle',$item?->subtitle) }}"></div>
    <div class="field"><label>Ikon / Nomor</label><input name="icon" value="{{ old('icon',$item?->icon) }}" placeholder="Contoh: 🎨 atau 01"></div>
    <div class="field full"><label>Deskripsi</label><textarea name="description" rows="4">{{ old('description',$item?->description) }}</textarea></div>
    @if($item?->image_path)<div class="field full"><label>Gambar saat ini</label><img src="{{ asset('storage/'.$item->image_path) }}" alt="" style="width:180px;border-radius:8px"></div>@endif
    <div class="field"><label>Gambar preview (maks. 3 MB)</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></div>
    <div class="field"><label>URL website contoh</label><input type="url" name="project_url" value="{{ old('project_url',$item?->project_url) }}" placeholder="https://contoh.sch.id"></div>
    <div class="field"><label>Harga (khusus paket)</label><input name="price" value="{{ old('price',$item?->price) }}"></div>
    <div class="field"><label>Urutan</label><input type="number" min="0" name="sort_order" value="{{ old('sort_order',$item?->sort_order ?? 0) }}"></div>
    <div class="field full"><label>Daftar fitur (satu per baris, khusus paket)</label><textarea name="features" rows="5">{{ old('features',implode("\n",$item?->meta['features'] ?? [])) }}</textarea></div>
    <div class="field full"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active',$item?->is_active ?? true)?'checked':'' }}> Tampilkan di landing page</label></div>
    <div class="field full"><button class="btn btn-blue">Simpan Konten</button></div>
</div>
