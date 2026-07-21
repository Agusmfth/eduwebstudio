@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<section class="welcome"><div><span>{{ now()->translatedFormat('l, d F Y') }}</span><h2>Selamat datang kembali, {{ explode(' ',auth()->user()->name)[0] }}.</h2><p>Kelola konten landing page dan pantau pesan konsultasi dari satu tempat.</p></div><a href="{{ route('home') }}" target="_blank">Preview website <b>↗</b></a></section>
<section class="stat-grid">
    <article class="stat-card highlight"><div class="stat-icon">✉</div><div><span>Pesan belum dibaca</span><strong>{{ \App\Models\Inquiry::where('is_read',false)->count() }}</strong><small>Perlu ditindaklanjuti</small></div><a href="{{ route('admin.inquiries') }}">→</a></article>
    <article class="stat-card"><div class="stat-icon">▦</div><div><span>Total konten aktif</span><strong>{{ \App\Models\ContentItem::where('is_active',true)->count() }}</strong><small>Ditampilkan di website</small></div></article>
    <article class="stat-card"><div class="stat-icon">◫</div><div><span>Portofolio</span><strong>{{ $counts['portfolio'] ?? 0 }}</strong><small>Proyek ditampilkan</small></div></article>
    <article class="stat-card"><div class="stat-icon">◎</div><div><span>Paket layanan</span><strong>{{ $counts['pricing'] ?? 0 }}</strong><small>Pilihan tersedia</small></div></article>
</section>
<div class="dashboard-grid">
    <section class="panel recent"><div class="panel-heading"><div><h3>Pesan konsultasi terbaru</h3><p>Permintaan yang masuk melalui landing page.</p></div><a href="{{ route('admin.inquiries') }}">Lihat semua →</a></div><div class="table-wrap"><table><thead><tr><th>Pengirim</th><th>Kontak</th><th>Pesan</th><th>Status</th></tr></thead><tbody>@forelse($latest as $row)<tr><td><div class="person"><span>{{ strtoupper(substr($row->name,0,1)) }}</span><div><strong>{{ $row->name }}</strong><small>{{ $row->school ?: 'Tanpa institusi' }}</small></div></div></td><td>{{ $row->phone }}<small>{{ $row->email }}</small></td><td>{{ Str::limit($row->message,65) }}</td><td><span class="status {{ $row->is_read?'read':'new' }}">{{ $row->is_read?'Dibaca':'Baru' }}</span></td></tr>@empty<tr><td colspan="4" class="empty">Belum ada pesan konsultasi.</td></tr>@endforelse</tbody></table></div></section>
    <aside class="panel quick"><div class="panel-heading"><div><h3>Akses cepat</h3><p>Kelola bagian penting.</p></div></div>@foreach(['services'=>'Layanan','portfolio'=>'Portofolio','pricing'=>'Paket Harga','faqs'=>'FAQ'] as $key=>$name)<a href="{{ route('admin.content.index',$key) }}"><span>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span><div><strong>{{ $name }}</strong><small>{{ $counts[$key] ?? 0 }} konten</small></div><b>→</b></a>@endforeach</aside>
</div>
@endsection
