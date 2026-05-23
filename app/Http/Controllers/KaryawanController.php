<?php

namespace App\Http\Controllers;

use App\Enums\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::withCount('gajiKaryawans')->orderByDesc('created_at')->get();

        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        $jabatanOptions = Jabatan::cases();

        return view('karyawan.create', compact('jabatanOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => ['required', Rule::in(array_column(Jabatan::cases(), 'value'))],
            'nik' => 'required|string|max:32',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        Karyawan::create($data);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan.');
    }

    public function edit(Karyawan $karyawan)
    {
        $jabatanOptions = Jabatan::cases();

        return view('karyawan.edit', compact('karyawan', 'jabatanOptions'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => ['required', Rule::in(array_column(Jabatan::cases(), 'value'))],
            'nik' => 'required|string|max:32',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $karyawan->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
