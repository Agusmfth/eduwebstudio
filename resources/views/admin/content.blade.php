@extends('layouts.admin')
@section('title', $label)
@section('content')
<div class="panel">
    <div class="panel-head"><div><h2>Daftar {{ $label }}</h2><span class="muted">Urutan kecil tampil lebih dahulu.</span></div><button class="btn btn-blue" onclick="openModal('newModal')">+ Tambah</button></div>
    <div class="table-wrap"><table><thead><tr><th>Urutan</th><th>Konten</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
    @forelse($records as $row)
        <tr><td>{{ $row->sort_order }}</td><td><strong>{{ $row->icon }} {{ $row->title }}</strong><br><span class="muted">{{ Str::limit($row->description,100) }}</span></td><td><span class="badge {{ $row->is_active?'':'off' }}">{{ $row->is_active?'Aktif':'Nonaktif' }}</span></td><td><div class="actions"><button class="btn btn-light" onclick="openModal('edit{{ $row->id }}')">Edit</button><form method="post" action="{{ route('admin.content.destroy',[$section,$row]) }}" onsubmit="return confirm('Hapus konten ini?')">@csrf @method('delete')<button class="btn btn-danger">Hapus</button></form></div></td></tr>
        <div class="modal" id="edit{{ $row->id }}"><div class="modal-card"><div class="modal-head"><h2>Edit {{ $label }}</h2><button class="btn" onclick="closeModal('edit{{ $row->id }}')">✕</button></div><form method="post" enctype="multipart/form-data" action="{{ route('admin.content.update',[$section,$row]) }}">@csrf @method('put') @include('admin.partials.content-form',['item'=>$row])</form></div></div>
    @empty
        <tr><td colspan="4">Belum ada konten.</td></tr>
    @endforelse
    </tbody></table></div>
</div>
<div class="modal" id="newModal"><div class="modal-card"><div class="modal-head"><h2>Tambah {{ $label }}</h2><button class="btn" onclick="closeModal('newModal')">✕</button></div><form method="post" enctype="multipart/form-data" action="{{ route('admin.content.store',$section) }}">@csrf @include('admin.partials.content-form',['item'=>null])</form></div></div>
@endsection
@push('scripts')<script>function openModal(id){document.getElementById(id).classList.add('open')}function closeModal(id){document.getElementById(id).classList.remove('open')}</script>@endpush
