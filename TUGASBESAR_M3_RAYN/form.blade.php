@extends('admin.layout')

@section('title', $teknisi->exists ? 'Ubah Teknisi' : 'Tambah Teknisi')

@section('content')
    <div class="judul">
        <h2>{{ $teknisi->exists ? 'Ubah Teknisi' : 'Tambah Teknisi' }}</h2>
    </div>

    <form method="POST" class="form-box"
          action="{{ $teknisi->exists ? route('admin.teknisi.update', $teknisi) : route('admin.teknisi.store') }}">
        @csrf
        @if ($teknisi->exists)
            @method('PUT')
        @endif

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $teknisi->nama) }}">
        @error('nama') <div class="error">{{ $message }}</div> @enderror

        <label for="spesialisasi">Spesialisasi</label>
        <select id="spesialisasi" name="spesialisasi">
            <option value="">-- Pilih spesialisasi --</option>
            @foreach (\App\Models\Teknisi::SPESIALISASI as $sp)
                <option value="{{ $sp }}" @selected(old('spesialisasi', $teknisi->spesialisasi) === $sp)>{{ $sp }}</option>
            @endforeach
        </select>
        @error('spesialisasi') <div class="error">{{ $message }}</div> @enderror

        <label for="user_id">Akun login (opsional)</label>
        <select id="user_id" name="user_id">
            <option value="">-- Tanpa akun --</option>
            @foreach ($users as $u)
                <option value="{{ $u->id }}" @selected((string) old('user_id', $teknisi->user_id) === (string) $u->id)>{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
        </select>
        @error('user_id') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="{{ old('email', $teknisi->email) }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $teknisi->telepon) }}">
        @error('telepon') <div class="error">{{ $message }}</div> @enderror

        <label for="status">Status</label>
        <select id="status" name="status">
            @foreach (['tersedia', 'sibuk', 'libur'] as $s)
                <option value="{{ $s }}" @selected(old('status', $teknisi->status ?? 'tersedia') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        @error('status') <div class="error">{{ $message }}</div> @enderror

        <div style="margin-top:20px;display:flex;gap:8px;">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('admin.teknisi.index') }}" class="btn abu">Batal</a>
        </div>
    </form>
@endsection