@extends('admin.layout')

@section('title', 'Aset')

@section('content')
    <div class="judul">
        <h2>Aset</h2>
        <a href="{{ route('admin.aset.create') }}" class="btn">+ Tambah Aset</a>
    </div>

    @if (session('sukses'))
        <div class="alert">{{ session('sukses') }}</div>
    @endif

    <table>
        <thead>
            <tr><th>Kode</th><th>Perangkat</th><th>Departemen</th><th>Pengguna</th><th>Kondisi</th><th>Servis terakhir</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($daftar as $a)
                <tr>
                    <td>{{ $a->kode }}</td>
                    <td>{{ $a->perangkat }}</td>
                    <td>{{ $a->departemen }}</td>
                    <td>{{ $a->pengguna ?? '-' }}</td>
                    <td>{{ $a->kondisi }}</td>
                    <td>{{ $a->servis_terakhir?->format('d/m/Y') ?? '-' }}</td>
                    <td class="aksi">
                        <a href="{{ route('admin.aset.edit', $a) }}" class="btn abu">Ubah</a>
                        <form method="POST" action="{{ route('admin.aset.destroy', $a) }}" onsubmit="return confirm('Hapus aset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn merah">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada aset.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection