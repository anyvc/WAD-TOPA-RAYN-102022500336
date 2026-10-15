@extends('admin.layout')

@section('title', $aset->exists ? 'Ubah Aset' : 'Tambah Aset')

@section('content')
    <div class="judul">
        <h2>{{ $aset->exists ? 'Ubah Aset' : 'Tambah Aset' }}</h2>
    </div>

    <form method="POST" class="form-box"
          action="{{ $aset->exists ? route('admin.aset.update', $aset) : route('admin.aset.store') }}">
        @csrf
        @if ($aset->exists)
            @method('PUT')
        @endif

        <label for="kode">Kode aset</label>
        <input type="text" id="kode" name="kode" value="{{ old('kode', $aset->kode) }}" placeholder="Contoh: PC-KEU-014">
        @error('kode') <div class="error">{{ $message }}</div> @enderror

        <label for="perangkat">Perangkat</label>
        <input type="text" id="perangkat" name="perangkat" value="{{ old('perangkat', $aset->perangkat) }}" placeholder="Contoh: PC Desktop, Laptop, Printer Laser">
        @error('perangkat') <div class="error">{{ $message }}</div> @enderror

        <label for="departemen">Departemen</label>
        <input type="text" id="departemen" name="departemen" list="daftar-dept" value="{{ old('departemen', $aset->departemen) }}">
        <datalist id="daftar-dept">
            @foreach (['Keuangan', 'HRD', 'Pemasaran', 'Operasional', 'Produksi'] as $d)
                <option value="{{ $d }}">
            @endforeach
        </datalist>
        @error('departemen') <div class="error">{{ $message }}</div> @enderror

        <label for="pengguna">Pengguna</label>
        <input type="text" id="pengguna" name="pengguna" value="{{ old('pengguna', $aset->pengguna) }}" placeholder="Contoh: Anita, atau Bersama">
        @error('pengguna') <div class="error">{{ $message }}</div> @enderror

        <label for="kondisi">Kondisi</label>
        <select id="kondisi" name="kondisi">
            @foreach (['Baik', 'Perlu servis', 'Rusak'] as $k)
                <option value="{{ $k }}" @selected(old('kondisi', $aset->kondisi ?? 'Baik') === $k)>{{ $k }}</option>
            @endforeach
        </select>
        @error('kondisi') <div class="error">{{ $message }}</div> @enderror

        <label for="servis_terakhir">Servis terakhir</label>
        <input type="date" id="servis_terakhir" name="servis_terakhir" value="{{ old('servis_terakhir', $aset->servis_terakhir?->format('Y-m-d')) }}">
        @error('servis_terakhir') <div class="error">{{ $message }}</div> @enderror

        <div style="margin-top:20px;display:flex;gap:8px;">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('admin.aset.index') }}" class="btn abu">Batal</a>
        </div>
    </form>
@endsection