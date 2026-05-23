@extends('layouts.app')

@section('title', 'Edit Karyawan - Aplikasi Penggajian')

@section('content')
    <x-sidebar active="karyawan.index" />
    <div class="flex justify-center items-center w-full">
        <div class="max-w-5xl px-4 py-10 lg:ml-80">
            <div class="mb-8 rounded-xl border border-slate-200 bg-white p-8 shadow-[0_35px_80px_rgba(15,23,42,0.08)]">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-600">Data Karyawan</p>
                        <h1 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900">Edit Karyawan</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Perbarui informasi karyawan dan jabatan.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 sm:items-end">
                        <span
                            class="rounded-full bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm">Periode:
                            {{ date('d F Y') }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('karyawan.index') }}"
                                class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-3xl border border-rose-200 bg-rose-50 px-6 py-4 text-sm text-rose-700 shadow-sm">
                    <p class="font-semibold">Perbaiki kesalahan berikut:</p>
                    <ul class="mt-3 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('karyawan.update', $karyawan) }}" method="post"
                class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_60px_rgba(15,23,42,0.06)]">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="nama">Nama Karyawan</label>
                            <input id="nama" name="nama" type="text" value="{{ old('nama', $karyawan->nama) }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="jabatan">Jabatan</label>
                            <select id="jabatan" name="jabatan" required
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                                <option value="">Pilih jabatan</option>
                                @foreach ($jabatanOptions as $jabatan)
                                    <option value="{{ $jabatan->value }}"
                                        {{ old('jabatan', $karyawan->jabatan?->value ?? $karyawan->jabatan) === $jabatan->value ? 'selected' : '' }}>
                                        {{ $jabatan->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="nik">NIK</label>
                            <input id="nik" name="nik" type="text" value="{{ old('nik', $karyawan->nik) }}"
                                placeholder="Masukkan NIK"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="no_telp">No. Telepon</label>
                            <input id="no_telp" name="no_telp" type="text"
                                value="{{ old('no_telp', $karyawan->no_telp) }}" placeholder="0812xxxxxxx"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="email">Email</label>
                            <input id="email" name="email" type="email"
                                value="{{ old('email', $karyawan->email) }}" placeholder="email@domain.com"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('karyawan.index') }}"
                        class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-8 py-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-8 py-4 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">Perbarui
                        Karyawan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
