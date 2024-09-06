@extends('landing.layouts.app')
@section('extra-title') ProgramKu @endsection

@section('page-title')
    <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
        <h1 class="text-white">ProgramKu</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col w-full px-2 md:px-12">
        {{-- Section search --}}
        <div class="flex flex-row items-center justify-center py-8 md:py-16 w-full">
            <form class="flex flex-row items-center w-full md:w-9/12" action="{{ route('workshops.index') }}" method="GET">
                <div class="relative flex flex-1 mr-3 md:mr-6">
                    <svg class="absolute top-2 md:top-2.5 ml-2 md:ml-4 w-6 h-6 md:w-8 md:h-8" width="33" height="32"
                        viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_248_3601)">
                            <path
                                d="M21.1665 18.6667H20.1132L19.7399 18.3067C21.3399 16.44 22.1665 13.8933 21.7132 11.1867C21.0865 7.48001 17.9932 4.52001 14.2599 4.06668C8.61986 3.37334 3.87319 8.12001 4.56652 13.76C5.01986 17.4933 7.97986 20.5867 11.6865 21.2133C14.3932 21.6667 16.9399 20.84 18.8065 19.24L19.1665 19.6133V20.6667L24.8332 26.3333C25.3799 26.88 26.2732 26.88 26.8199 26.3333C27.3665 25.7867 27.3665 24.8933 26.8199 24.3467L21.1665 18.6667ZM13.1665 18.6667C9.84652 18.6667 7.16652 15.9867 7.16652 12.6667C7.16652 9.34668 9.84652 6.66668 13.1665 6.66668C16.4865 6.66668 19.1665 9.34668 19.1665 12.6667C19.1665 15.9867 16.4865 18.6667 13.1665 18.6667Z"
                                fill="#4B5563" />
                        </g>
                        <defs>
                            <clipPath id="clip0_248_3601">
                                <rect width="32" height="32" fill="white" transform="translate(0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <input type="text"
                        class="rounded-xl border border-gray-400 pl-10 md:pl-16 py-2 md:py-3 text-sm md:text-base placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600"
                        name="search" placeholder="Cari berdasarkan judul, pelaksana atau tempat"
                        value="{{ request()->input('search') }}" />
                </div>
                <button type="submit"
                    class="px-5 md:px-7 py-2 md:py-3 text-sm md:text-base font-semibold border border-primary bg-primary rounded-xl text-white"><span
                        class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Program</span></button>
            </form>
        </div>

        {{-- Section program --}}
        <div class="flex flex-col py-6 w-full gap-x-8 mb-24">
            <h3 class="text-2xl font-bold mb-8 md:mb-12">Program Kewirausahaan yang anda ikuti</h3>

            @if ($workshops->isEmpty())
                <div class="flex justify-center py-10 md:py-14 md:-mx-[76px] items-center start-program-text">
                    <a href="{{ route('workshops.index') }}">
                        <h2 class="text-2xl md:text-4xl text-center text-primary font-bold mb-6 md:mb-8">Yuk! Mulai Pilih
                            Programmu</h2>
                    </a>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-7 gap-y-9">
                @foreach ($workshops as $workshop)
                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6 workshop">
                        <div class="flex flex-1">
                            <img class="w-full h-[200px] md:h-[240px] mx-auto object-cover rounded"
                                src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}"
                                onerror="this.src='{{ asset('images/news/placeholder.png') }}'" />
                        </div>
                        <div class="pt-4 flex-1">
                            <div class="flex flex-col h-full justify-between">
                                <div class="flex flex-col items-start">
                                    <div class="flex flex-row items-center gap-2">
                                        <img class="w-auto h-8 object-contain"
                                            src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}"
                                            alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                                        <span
                                            class="text-xs md:text-sm">{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-1 py-2">
                                        @foreach ($workshop->hasTags as $tag)
                                            <span
                                                class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="font-bold text-base md:text-xl mb-2">{{ $workshop->title }}</h4>
                                </div>
                                <div>
                                    <div class="flex flex-row items-center gap-2 mb-3 md:mb-4 text-xs md:text-sm">
                                        <ion-icon name="calendar-outline" class="text-[#9CA3AF]"></ion-icon>
                                        <span
                                            class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }}
                                            WIB</span>
                                    </div>
                                    <a href="{{ route('workshops.detail', $workshop->slug) }}"
                                        class="btn btn-lg btn-primary btn-block text-sm md:text-base">Lihat Program</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (!empty($workshops))
                <div class="flex justify-center my-12">{{ $workshops->links('vendor.pagination.custom-2') }}</div>
            @endif
        </div>
    </div>
@endsection
