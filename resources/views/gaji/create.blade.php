@extends('layouts.app')

@section('title', 'Tambah Slip Gaji - Aplikasi Penggajian')

@section('content')
    <x-sidebar active="gaji.create" />

    <div class="flex justify-center items-center w-full">
        <div class="max-w-7xl px-4 py-10 lg:ml-80">
            <div class="mb-8 rounded-xl border border-slate-200 bg-white p-8 shadow-[0_35px_80px_rgba(15,23,42,0.08)]">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-600">Slip Gaji</p>
                        <h1 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900">Tambah Gaji Karyawan</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Pilih karyawan dan isi data gaji untuk
                            membuat slip gaji terpisah.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:items-end">
                        <span
                            class="rounded-full bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm">Periode:
                            {{ date('d F Y') }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('gaji.index') }}"
                                class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

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

            <form action="{{ route('gaji.store') }}" method="post" class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
                @csrf
                <section
                    class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_60px_rgba(15,23,42,0.06)]">
                    <div class="mb-8 space-y-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-500">Data Slip Gaji</p>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="karyawan_id">Pilih Karyawan</label>
                            <select id="karyawan_id" name="karyawan_id" required
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                                <option value="">Pilih karyawan</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}"
                                        {{ old('karyawan_id', $selectedKaryawanId) == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-600" for="gaji_pokok">Gaji Pokok</label>
                                <input id="gaji_pokok" name="gaji_pokok" type="number" min="0"
                                    value="{{ old('gaji_pokok', 0) }}" placeholder="0" oninput="updateTotals()"
                                    class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-600" for="lembur">Lembur</label>
                                <input id="lembur" name="lembur" type="number" min="0"
                                    value="{{ old('lembur', 0) }}" placeholder="0" oninput="updateTotals()"
                                    class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                    required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600" for="pinjaman">Pinjaman</label>
                            <input id="pinjaman" name="pinjaman" type="number" min="0"
                                value="{{ old('pinjaman', 0) }}" placeholder="0" oninput="updateTotals()"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-600"
                                for="captcha_answer">{{ $captchaQuestion }}</label>
                            <input id="captcha_answer" name="captcha_answer" type="number" min="0"
                                value="{{ old('captcha_answer') }}" placeholder="Masukkan jawaban"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                required>
                            @error('captcha_answer')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col gap-4">
                        <div class="flex items-center rounded-3xl p-5 justify-between bg-slate-50 text-sm text-slate-500">
                            <span>Total Penghasilan</span>
                            <span id="totalPenghasilan">Rp 0</span>
                        </div>
                        <div class="flex items-center rounded-3xl p-5 justify-between bg-slate-50 text-sm text-slate-500">
                            <span>Total Potongan</span>
                            <span id="totalPotongan">Rp 0</span>
                        </div>
                    </div>
                </section>

                <aside class="space-y-6">
                    <div
                        class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_60px_rgba(15,23,42,0.06)]">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-500">Ringkasan gaji</p>
                        <div class="mt-6 rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.22em] text-slate-500">Gaji Bersih</p>
                                    <p id="gajiBersih" class="mt-3 text-4xl font-semibold text-indigo-600">Rp 0</p>
                                </div>
                                <div class="rounded-3xl bg-white p-4 text-sm font-semibold text-slate-700 shadow-sm">Auto
                                    hitung</div>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-600">Nilai akan terhitung secara otomatis saat angka
                                dimasukkan.</p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end xl:justify-start">
                        <button type="submit"
                            class="inline-flex items-center w-full justify-center rounded-full bg-indigo-600 px-8 py-4 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">Submit</button>
                    </div>
                </aside>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const formatIDR = value => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(Math.round(value));

        const getValue = id => Number(document.getElementById(id)?.value || 0);

        const updateTotals = () => {
            const gaji = getValue('gaji_pokok');
            const lembur = getValue('lembur');
            const pinjaman = getValue('pinjaman');
            const totalPenghasilan = Math.max(0, gaji + lembur);
            const totalPotongan = Math.max(0, pinjaman);
            const gajiBersih = Math.max(0, totalPenghasilan - totalPotongan);

            document.getElementById('totalPenghasilan').textContent = formatIDR(totalPenghasilan);
            document.getElementById('totalPotongan').textContent = formatIDR(totalPotongan);
            document.getElementById('gajiBersih').textContent = formatIDR(gajiBersih);
        };

        document.querySelectorAll('#gaji_pokok, #lembur, #pinjaman').forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        updateTotals();
    </script>
@endpush
