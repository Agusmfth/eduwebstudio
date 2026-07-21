<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title') — EduWeb Admin</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="{{ asset('css/admin-v2.css') }}"></head><body>
<div class="admin-shell">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand"><span class="brand-symbol">E</span><div><strong>EduWeb</strong><small>Content Manager</small></div><button class="sidebar-close" id="sidebarClose">×</button></div>
        <div class="site-status"><i></i><div><strong>Website aktif</strong><small>Semua sistem berjalan</small></div></div>
        <nav class="side-nav">
            <span class="nav-label">Ringkasan</span>
            <a class="{{ request()->routeIs('admin.dashboard')?'active':'' }}" href="{{ route('admin.dashboard') }}"><i>⌂</i><span>Dashboard</span></a>
            <a class="{{ request()->routeIs('admin.inquiries')?'active':'' }}" href="{{ route('admin.inquiries') }}"><i>✉</i><span>Pesan konsultasi</span>@php($unread=\App\Models\Inquiry::where('is_read',false)->count())@if($unread)<b>{{ $unread }}</b>@endif</a>
            <span class="nav-label">Konten Landing Page</span>
            @foreach(\App\Http\Controllers\Admin\ContentController::SECTIONS as $key=>$name)
                <a class="{{ request()->route('section')===$key?'active':'' }}" href="{{ route('admin.content.index',$key) }}"><i>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</i><span>{{ $name }}</span></a>
            @endforeach
            <span class="nav-label">Konfigurasi</span>
            <a class="{{ request()->routeIs('admin.settings.edit')?'active':'' }}" href="{{ route('admin.settings.edit') }}"><i>⚙</i><span>Pengaturan website</span></a>
        </nav>
        <div class="sidebar-foot"><a href="{{ route('home') }}" target="_blank"><span>Lihat landing page</span><b>↗</b></a><form method="post" action="{{ route('logout') }}">@csrf<button><span>Keluar dari akun</span><b>→</b></button></form></div>
    </aside>
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <main class="admin-main">
        <header class="topbar"><button class="mobile-menu" id="mobileMenu">☰</button><div><span class="breadcrumb">EduWeb Studio / @yield('title')</span><h1>@yield('title')</h1></div><div class="admin-profile"><span>{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span><div><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></div></div></header>
        <div class="page-content">
            @if(session('success'))<div class="flash success"><span>✓</span><p>{{ session('success') }}</p><button onclick="this.parentElement.remove()">×</button></div>@endif
            @if($errors->any())<div class="flash error"><span>!</span><p>{{ $errors->first() }}</p><button onclick="this.parentElement.remove()">×</button></div>@endif
            @yield('content')
        </div>
    </main>
</div>
@stack('scripts')
<script>const sidebar=document.getElementById('sidebar'),overlay=document.getElementById('mobileOverlay');document.getElementById('mobileMenu').onclick=()=>{sidebar.classList.add('open');overlay.classList.add('show')};function closeSide(){sidebar.classList.remove('open');overlay.classList.remove('show')}document.getElementById('sidebarClose').onclick=closeSide;overlay.onclick=closeSide;</script>
</body></html>
