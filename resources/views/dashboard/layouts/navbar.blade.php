<div class="flex justify-between items-center">
    <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ route('dashboard.index') }}'">
        <img class="w-24 sm:w-32" src="{{ asset('images/logo-kemenkop-new.png') }}" alt="Logo Kemenkop" />
        <img class="w-16 sm:w-24" src="{{ asset('images/logo-ehub-new.png') }}" alt="Logo EnterpreneurHub" />
    </div>
    <div class="flex items-center gap-4">
        <div class="group relative">
            <div class="flex items-center gap-2">
                <p>
                <section class="hidden">Hallo,</section><b class="text-gray-700">{{ auth()->user()->fullname }}</b></p>
                <button type="button" class="pr-2">
                    <img class="w-8 h-auto object-contain rounded-full" src="{{ asset('images/avatar-boy.png') }}"
                        alt="avatar profile" />
                </button>
            </div>
            <nav tabindex="0"
                class="border border-gray-300 shadow-xl bg-white invisible rounded w-40 absolute right-0 top-full transition-all opacity-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-1">
                <ul class="py-1">
                    <li>
                        <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Halaman Utama
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Keluar
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
