@extends('layouts.app')

@section('title', 'Daftar Karyawan - Aplikasi Penggajian')

@section('content')
    <x-sidebar active="karyawan.index" />

    <div class="mx-auto px-4 py-10 lg:ml-80">
        <div class="mb-8 rounded-xl border border-slate-200 bg-white p-8 shadow-[0_35px_80px_rgba(15,23,42,0.08)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-600">Aplikasi Penggajian</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Daftar Karyawan</h1>
                    <p class="max-w-2xl text-sm leading-6 text-slate-600">Kelola data karyawan dan siapkan slip gaji terpisah
                        lewat modul gaji.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="rounded-3xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600 shadow-sm">Total
                        Karyawa:
                        {{ $karyawans->count() }}</div>

                    <a href="{{ route('karyawan.create') }}"
                        class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">Tambah
                        Karyawan</a>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_30px_60px_rgba(15,23,42,0.06)]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">No</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">NIK
                            </th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Nama
                            </th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Jabatan
                            </th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Email
                            </th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">No.
                                Telp</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Slip
                                Gaji</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($karyawans as $index => $karyawan)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $karyawan->nik }}</td>
                                <td class="px-6 py-4">{{ $karyawan->nama }}</td>
                                <td class="px-6 py-4">
                                    {{ optional($karyawan->jabatan)->label() ?? ucfirst($karyawan->jabatan ?? '') }}</td>
                                <td class="px-6 py-4">{{ $karyawan->email }}</td>
                                <td class="px-6 py-4">{{ $karyawan->no_telp }}</td>
                                <td class="px-6 py-4">{{ $karyawan->gaji_karyawans_count }}</td>
                                <td class="px-6 py-4 flex flex-col gap-2 sm:flex-row sm:items-center">
                                    <a href="{{ route('gaji.create', ['karyawan_id' => $karyawan->id]) }}"
                                        class="inline-flex rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Tambah
                                        Slip</a>
                                    <a href="{{ route('karyawan.export.pdf', $karyawan) }}"
                                        class="inline-flex rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">Export
                                        PDF</a>
                                    <a href="{{ route('karyawan.edit', $karyawan) }}"
                                        class="inline-flex rounded-full bg-yellow-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('karyawan.destroy', $karyawan) }}" method="post"
                                        class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus karyawan ini?');"
                                            class="inline-flex rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada data
                                    karyawan. Silakan tambahkan karyawan terlebih dahulu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
