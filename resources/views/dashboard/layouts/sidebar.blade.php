<ul class="flex flex-col gap-2 text-gray-600 text-base font-medium px-4 py-28">
    @role('admin')
    <li class="px-6 rounded-lg border-b-2 mb-10 {{ request()->is('dashboard') ? 'bg-slate-100' : '' }}">
        <a href="{{ route('dashboard.index') }}" class="mb-4">
            <div class="flex-row flex items-center gap-2">
                <ion-icon name="home"></ion-icon>
                <span class="block py-2">Beranda</span>
            </div>
        </a>
    </li>
    @endrole

    @role('entrepreneur')
        <li class="px-6 rounded-lg border-b-2 {{ request()->is('dashboard') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.workshops.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="calendar"></ion-icon>
                    <span class="block py-2">Program</span>
                </div>
            </a>
        </li>
    @endrole

    @role('admin|institution')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-entrepreneurs') || request()->is('management-entrepreneurs/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.entrepreneurs.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="briefcase"></ion-icon>
                    <span class="block py-2">Wirausaha</span>
                </div>
            </a>
        </li>
    @endrole
    @hasanyrole('admin|collaborator|institution')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-news') || request()->is('management-news/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.news.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="newspaper"></ion-icon>
                    <span class="block py-2">Kabar</span>
                </div>
            </a>
        </li>
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-workshops') || request()->is('management-workshops/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.workshops.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="calendar"></ion-icon>
                    <span class="block py-2">Program</span>
                </div>
            </a>
        </li>
    @endhasanyrole
    @role('admin')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-collaborators') || request()->is('management-collaborators/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.collaborators.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="people"></ion-icon>
                    <span class="block py-2">Kolaborator</span>
                </div>
            </a>
        </li>
    @endrole
    @hasanyrole('admin|collaborator|institution')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-mentors') || request()->is('management-mentors/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.mentors.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="person-circle"></ion-icon>
                    <span class="block py-2">Mentor</span>
                </div>
            </a>
        </li>
    @endhasanyrole
    @role('admin')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-templates') || request()->is('management-templates/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.templates.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="document"></ion-icon>
                    <span class="block py-2">Materi</span>
                </div>
            </a>
        </li>
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-administrators') || request()->is('management-administrators/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.administrators.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="settings"></ion-icon>
                    <span class="block py-2">Administrator</span>
                </div>
            </a>
        </li>
    @endrole
    @role('admin')
        <li
            class="px-6 rounded-lg border-b-2 {{ request()->is('management-logos') || request()->is('management-logos/*') ? 'bg-slate-100' : '' }}">
            <a href="{{ route('dashboard.logos.index') }}" class="mb-4">
                <div class="flex-row flex items-center gap-2">
                    <ion-icon name="image"></ion-icon>
                    <span class="block py-2">Logo</span>
                </div>
            </a>
        </li>
    @endrole
</ul>
