@props(['active' => null])

@php
    $active = $active ?? request()->route()->getName();
    $links = [
        [
            'label' => 'Karyawan',
            'route' => 'karyawan.index',
        ],
        [
            'label' => 'Slip Gaji',
            'route' => 'gaji.index',
        ],
    ];

    $user = auth()->user();
    $userName = $user?->name ?? 'Guest User';
    $userEmail = $user?->email ?? 'guest@example.com';
    $avatarLetter = strtoupper(substr($userName, 0, 1));
    $avatarColors = [
        'bg-indigo-600',
        'bg-cyan-600',
        'bg-emerald-600',
        'bg-rose-600',
        'bg-slate-700',
        'bg-violet-600',
        'bg-yellow-500',
    ];
    $colorIndex = $userName ? ord(strtolower($userName[0])) % count($avatarColors) : rand(0, count($avatarColors) - 1);
    $avatarColor = $avatarColors[$colorIndex];
@endphp

<aside
    class="hidden lg:block lg:fixed lg:inset-y-0 lg:left-0 lg:w-80 lg:border-r lg:border-slate-200 lg:bg-white lg:px-6 lg:py-8 lg:shadow-xl lg:z-20">
    <div class="sticky top-6 flex h-[calc(100vh-3rem)] flex-col justify-between gap-8">
        <div class="space-y-6">
            <div class="flex items-center gap-3 rounded-3xl bg-slate-100 px-4 py-4 shadow-sm">
                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-indigo-600 text-white font-bold uppercase">A
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-indigo-600">Payroll App</p>
                    <h2 class="text-lg font-semibold text-slate-900">ALMUTAKIN</h2>
                </div>
            </div>

            <nav class="space-y-3">
                @foreach ($links as $link)
                    @php $isActive = $active === $link['route']; @endphp
                    <a href="{{ route($link['route']) }}"
                        class="block rounded-3xl border px-5 py-4 text-sm font-semibold transition {{ $isActive ? 'border-indigo-600 bg-indigo-600 text-white shadow-lg hover:bg-indigo-700' : 'border-slate-200 bg-white text-slate-700 shadow-sm hover:bg-slate-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div
                    class="flex h-14 w-14 items-center justify-center rounded-full text-lg font-bold text-white {{ $avatarColor }}">
                    {{ $avatarLetter }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">{{ $userName }}</p>
                    <p class="text-xs text-slate-500">{{ $userEmail }}</p>
                </div>
            </div>
            @auth
                <form action="{{ route('logout') }}" method="post" class="mt-5">
                    @csrf
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-3xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</aside>
