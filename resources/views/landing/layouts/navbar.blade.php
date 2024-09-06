<nav class="flex justify-between items-center h-20 mx-auto">
    <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ route('home.index') }}'">
        <img class="w-24 sm:w-32" src="{{ asset('images/logo-kemenkop-new.png') }}" alt="Logo Kemenkop" />
        <img class="w-16 sm:w-24" src="{{ asset('images/logo-ehub-new.png') }}" alt="Logo EnterpreneurHub" />
    </div>
    <div class="nav-links text-base">
        <ul>
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="nav-item {{ request()->is('about-us') ? 'active' : '' }}">
                <a href="{{ route('home.about-us') }}">Tentang Kami</a>
            </li>
            <li class="group relative hidden xl:nav-item {{ request()->is('entrepreneur-step') ? 'active' : '' }}">
                <a href="#">Wirausaha</a>
                <div class="hidden group-hover:block absolute top-20 w-full xl:w-auto h-auto bg-white shadow-lg rounded-b-lg"
                    style="width: max-content;">
                    <ul class="flex !flex-col !gap-2 !items-start">
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('home.entrepreneur-step', 'business-plan') }}">Rencanakan Usahamu</a>
                        </li>
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('home.entrepreneur-step', 'business-launch') }}">Buka Usahamu</a>
                        </li>
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('home.entrepreneur-step', 'business-growth') }}">Kembangkan Usahamu</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-item-mobile">
                <button
                    class="group focus:outline-none text-left nav-item {{ request()->is('entrepreneur-step*') ? 'active' : '' }}">
                    <div class="flex items-center justify-between font-medium text-primary w-fit">
                        <span class="truncate">Wirausaha</span>
                        <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-72">
                        <ul class="flex flex-col items-start justify-start" style="width: max-content;">
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('home.entrepreneur-step', 'business-plan') }}">Rencanakan Usahamu</a>
                            </li>
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('home.entrepreneur-step', 'business-launch') }}">Buka Usahamu</a>
                            </li>
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('home.entrepreneur-step', 'business-growth') }}">Kembangkan
                                    Usahamu</a>
                            </li>
                        </ul>
                    </div>
                </button>
            </li>
            <li
                class="group relative hidden xl:nav-item {{ request()->is(['workshops*', 'mentor*', 'collaborators*']) ? 'active' : '' }}">
                <a href="#">Layanan</a>
                <div class="hidden group-hover:block absolute top-20 w-full xl:w-auto h-auto bg-white shadow-lg rounded-b-lg"
                    style="width: max-content;">
                    <ul class="flex !flex-col !gap-2 !items-start">
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('workshops.index') }}">Program</a>
                        </li>
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('mentors.index') }}">Mentor</a>
                        </li>
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('umkm.index') }}">Kolaborator</a>
                        </li>
                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                            <a href="{{ route('templates.index') }}">Unduh Materi</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-item-mobile">
                <button
                    class="group focus:outline-none text-left nav-item {{ request()->is(['workshops*', 'mentor*', 'collaborators*']) ? 'active' : '' }}">
                    <div class="flex items-center justify-between font-medium text-primary w-fit">
                        <span class="truncate">Layanan</span>
                        <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-72">
                        <ul class="flex flex-col items-start justify-start" style="width: max-content;">
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('workshops.index') }}">Program</a>
                            </li>
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('mentors.index') }}">Mentor</a>
                            </li>
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('umkm.index') }}">Kolaborator</a>
                            </li>
                            <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                <a href="{{ route('templates.index') }}">Unduh Materi</a>
                            </li>
                        </ul>
                    </div>
                </button>
            </li>
            <li class="nav-item {{ request()->is('news*') ? 'active' : '' }}">
                <a href="{{ route('news.index') }}">Kabar</a>
            </li>
            <li class="nav-item {{ request()->is('contact-us') ? 'active' : '' }}">
                <a href="{{ route('home.contact-us') }}">Kontak Kami</a>
            </li>
            <li class="flex xl:hidden items-center py-2 w-full">
                @auth
                    @role('admin')
                        <a href="{{ route('dashboard.index') }}" class="btn btn-block btn-outline-primary">Beranda Saya</a>
                    @endrole
                    @role('institution')
                        <a href="{{ route('dashboard.entrepreneurs.index') }}" class="btn btn-block btn-outline-primary">Beranda Saya</a>
                    @endrole
                    @role('collaborator')
                        <a href="{{ route('dashboard.news.index') }}" class="btn btn-block btn-outline-primary">Beranda Saya</a>
                    @endrole
                    @role('entrepreneur')
                        <div class="nav-item nav-item-mobile">
                            <button
                                class="group focus:outline-none text-left nav-item {{ request()->is(['clientarea*']) ? 'active' : '' }}">
                                <div class="flex items-center justify-between font-medium text-primary w-fit gap-2">
                                    <img class="w-8 h-auto object-contain rounded-full"
                                        src="{{ Auth::user()->hasParticipant ? Auth::user()->hasParticipant->avatar_url ?? asset('images/avatar-boy.png') : asset('images/avatar-boy.png') }}"
                                        alt="avatar profile" />
                                    <p class="whitespace-nowrap">
                                        {{ Auth::user()->hasParticipant ? Auth::user()->hasParticipant->fullname : Auth::user()->fullname }}
                                    </p>
                                    <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-72">
                                    <ul class="flex flex-col items-start justify-start" style="width: max-content;">
                                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                            <a href="{{ route('clientarea.profile.index') }}">ProfilKu</a>
                                        </li>
                                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                            <a href="{{ route('clientarea.workshops.index') }}">ProgramKu</a>
                                        </li>
                                        <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                            <a href="{{ route('logout') }}">Keluar</a>
                                        </li>
                                    </ul>
                                </div>
                            </button>
                        </div>
                    @endrole
                @else
                    <div class="flex items-center gap-3 w-full">
                        <a href="{{ route('register') }}" class="btn btn-block btn-secondary">Register</a>
                        <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary">Login</a>
                    </div>
                @endauth
            </li>
        </ul>
    </div>
    <div class="hidden xl:flex gap-4">
        @auth
            @role('admin')
                <a href="{{ route('dashboard.index') }}" class="btn btn-block btn-outline-primary">Beranda</a>
            @endrole
            @role('institution')
                <a href="{{ route('dashboard.entrepreneurs.index') }}" class="btn btn-block btn-outline-primary">Beranda</a>
            @endrole
            @role('collaborator')
                <a href="{{ route('dashboard.news.index') }}" class="btn btn-block btn-outline-primary">Beranda</a>
            @endrole
            @role('entrepreneur')
                <div class="nav-links">
                    <ul>
                        <li class="group relative hidden md:nav-item {{ request()->is(['clientarea*']) ? 'active' : '' }}">
                            <div class="flex flex-row items-center gap-2">
                                <img class="w-8 h-auto object-contain rounded-full"
                                    src="{{ Auth::user()->hasParticipant ? Auth::user()->hasParticipant->avatar_url ?? asset('images/avatar-boy.png') : asset('images/avatar-boy.png') }}"
                                    alt="avatar profile" />
                                <p class="whitespace-nowrap">
                                    {{ Auth::user()->hasParticipant ? Auth::user()->hasParticipant->fullname : Auth::user()->fullname }}
                                </p>
                            </div>
                            <div class="hidden group-hover:block absolute top-16 w-full md:w-auto h-auto bg-white shadow-lg rounded-b-lg"
                                style="width: max-content;">
                                <ul class="flex !flex-col !gap-2 !items-start">
                                    <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                        <a href="{{ route('clientarea.profile.index') }}">ProfilKu</a>
                                    </li>
                                    <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                        <a href="{{ route('clientarea.workshops.index') }}">ProgramKu</a>
                                    </li>
                                    <li class="w-full px-6 !py-2 hover:bg-gray-200">
                                        <a href="{{ route('logout') }}">Keluar</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            @endrole
        @else
            <a href="{{ route('register') }}" class="btn btn-block btn-secondary">Register</a>
            <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary">Login</a>
        @endauth
    </div>
    <ion-icon name="menu" class="flex xl:hidden text-3xl cursor-pointer" onclick="onToggleMenu(this)"></ion-icon>
</nav>
