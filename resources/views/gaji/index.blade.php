@extends('layouts.app')

@section('title', 'Daftar Gaji Karyawan - Aplikasi Penggajian')

@section('content')
    <x-sidebar active="gaji.index" />

    <div class="mx-auto px-4 py-10 lg:ml-80">
        <div class="mb-8 rounded-xl border border-slate-200 bg-white p-8 shadow-[0_35px_80px_rgba(15,23,42,0.08)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-600">Aplikasi Penggajian</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Daftar Gaji Karyawan</h1>
                    <p class="max-w-2xl text-sm leading-6 text-slate-600">Kelola slip gaji tiap karyawan secara terpisah dan
                        simpan riwayat setiap periode.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="rounded-3xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600 shadow-sm">Total slip
                        gaji: {{ $gajiKaryawans->count() }}</div>
                    <a href="{{ route('karyawan.index') }}"
                        class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">
                        Export per Karyawan</a>
                    <a href="{{ route('gaji.create') }}"
                        class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">Tambah
                        Slip Gaji</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_30px_60px_rgba(15,23,42,0.06)]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">No</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">
                                Karyawan</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Gaji
                                Pokok</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Lembur
                            </th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">
                                Pinjaman</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.16em] text-slate-600">Total
                                Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($gajiKaryawans as $index => $gaji)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $gaji->karyawan->nama }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($gaji->lembur, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($gaji->pinjaman, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900">Rp
                                    {{ number_format(max(0, $gaji->gaji_bersih), 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada slip
                                    gaji. Silakan tambah slip gaji karyawan terlebih dahulu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
