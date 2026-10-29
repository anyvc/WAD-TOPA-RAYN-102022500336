<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeknisiRequest;
use App\Models\Teknisi;
use App\Models\User;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::with('user')->latest()->get();

        return view('admin.teknisi.index', compact('teknisi'));
    }

    public function create()
    {
        return view('admin.teknisi.form', [
            'teknisi' => new Teknisi(),
            'users' => $this->daftarUser(),
        ]);
    }

    public function store(TeknisiRequest $request)
    {
        Teknisi::create($request->validated());

        return redirect()->route('admin.teknisi.index')->with('sukses', 'Teknisi berhasil ditambahkan.');
    }

    public function edit(Teknisi $teknisi)
    {
        return view('admin.teknisi.form', [
            'teknisi' => $teknisi,
            'users' => $this->daftarUser($teknisi),
        ]);
    }

    public function update(Teknisi $teknisi, Tekni $request)
    {
        $teknisi->update($request->validated());

        return redirect()->route('admin.teknisi.index')->with('sukses', 'Teknisi berhasil diubah.');
    }

    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();

        return redirect()->route('admin.teknisi.index')->with('sukses', 'Teknisi berhasil dihapus.');
    }

    private function daftarUser(?Teknisi $teknisi = null)
    {
        return User::whereDoesntHave('Teknisi')
            ->when($teknisi?->user_id, fn ($q, $id) => $q->orWhere('id', $id))
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
    }
}