@extends('layouts.app')

@section('title', 'Login - Aplikasi Penggajian')

@section('content')
    <div class="min-h-screen bg-slate-100 flex justify-center items-center px-4 py-10 sm:px-6 lg:px-10">
        <div class="mx-auto grid w-full max-w-7xl gap-8 lg:grid-cols-[1.5fr_1.5fr]">
            <div class="hidden overflow-hidden rounded-[2rem] bg-white  lg:block">
                <div class="h-full bg-cover bg-center" style="background-image: url('{{ asset('image/5348077.jpg') }}');">
                    <div class="flex h-full flex-col justify-end bg-slate-950/40 p-10 m">
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-[2rem] bg-white shadow-[0_35px_80px_rgba(15,23,42,0.08)]">
                <div class="p-10 sm:p-12">
                    <div class="mb-8 text-center">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-indigo-600">Agent Login</p>
                        <h1 class="mt-4 text-3xl font-semibold text-slate-900">Welcome Back</h1>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Login to continue managing your payroll
                            application.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                            <p class="font-semibold">Terjadi kesalahan:</p>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="post" class="space-y-6">
                        @csrf
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-slate-600" for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                placeholder="email@domain.com">
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-medium text-slate-600" for="password">Password</label>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                placeholder="Enter your password">
                        </div>

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-full bg-indigo-600 px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">Sign
                            In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
