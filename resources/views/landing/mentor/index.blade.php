@extends('landing.layouts.app')
@section('extra-title') Mentor @endsection
@section('page-title')
    <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
        <h1 class="text-white">Mentor</h1>
    </div>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .splide__pagination__page {
            background-color: #1e51635a;
            color: #000;
        }

        .splide__pagination__page.is-active {
            background-color: #1E5163;
            color: #fff;
        }

        #collaborator-section .splide__arrow--next {
            right: -0.4rem;
        }

        #collaborator-section .splide__arrow--prev {
            left: -0.4rem;
        }

        .modal-active {
            overflow: hidden;
        }


        .modal {
            transform: scale(0);

            &.two {
                transform: scale(1);

                .overlay {
                    background: rgba(0, 0, 0, .0);
                    animation: fadeIn .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;

                    .modal-content {
                        opacity: 0;
                        animation: scaleUp .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
                    }
                }

                +.content {
                    animation: scaleBack .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
                }

                &.out {
                    animation: quickScaleDown 0s .5s linear forwards;

                    .overlay {
                        animation: fadeOut .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;

                        .modal-content {
                            animation: scaleDown .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
                        }
                    }

                    +.content {
                        animation: scaleForward .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
                    }
                }
            }
        }

        @keyframes fadeIn {
            0% {
                background: rgba(0, 0, 0, .0);
            }

            100% {
                background: rgba(0, 0, 0, .7);
            }
        }

        @keyframes fadeOut {
            0% {
                background: rgba(0, 0, 0, .7);
            }

            100% {
                background: rgba(0, 0, 0, .0);
            }
        }

        @keyframes scaleUp {
            0% {
                transform: scale(.8) translateY(1000px);
                opacity: 0;
            }

            100% {
                transform: scale(1) translateY(0px);
                opacity: 1;
            }
        }

        @keyframes scaleDown {
            0% {
                transform: scale(1) translateY(0px);
                opacity: 1;
            }

            100% {
                transform: scale(.8) translateY(1000px);
                opacity: 0;
            }
        }

        @keyframes scaleBack {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(.85);
            }
        }

        @keyframes scaleForward {
            0% {
                transform: scale(.85);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes quickScaleDown {
            0% {
                transform: scale(1);
            }

            99.9% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }
    </style>
@endsection

@section('content')
    <div class="flex flex-col w-full">
        {{-- Section search --}}
        <div class="flex flex-row items-center justify-center py-5 md:py-16 w-full">
            <form class="flex flex-row items-center w-full md:w-9/12">
                <div class="relative flex flex-1 mr-3 md:mr-6">
                    <svg class="absolute h-7 w-7 md:w-8 md:h-8 top-3 md:top-2.5 ml-2 md:ml-4" width="33" height="32"
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
                    <input name="keyword" type="text"
                        class="rounded-xl border border-gray-400 pl-10 md:pl-16 py-3 placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600"
                        placeholder="Cari mentor disini">
                </div>
                <button class="px-7 py-3 border border-primary bg-primary rounded-xl text-white"><span
                        class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Mentor</span></button>
            </form>
        </div>
        {{-- Section filter & mentor --}}
        <div class="flex flex-col lg:flex-row py-6 w-full gap-x-8 lg:mb-24">
            {{-- Filter --}}
            <div class="w-full lg:w-4/12 hidden lg:flex flex-col relative">
                <p class="text-2xl font-bold mb-6">Filter</p>
                <form method="GET" action="{{ route('mentors.index') }}" id="formFilter" class="flex flex-col">
                    <p class="text-lg font-semibold text-gray-400 font-sans mb-6">Kolaborator</p>
                    <div class="flex flex-col pb-6 gap-y-5 border-b border-gray-200">
                        <div class="flex flex-col h-[13rem] overflow-y-auto gap-y-5">
                            <div class="flex flex-col gap-y-5" id="collaboratorContainer">
                                @php
                                    $visibleCollaborators = $collaborators->take(5);
                                @endphp
                                @foreach ($visibleCollaborators as $item)
                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" name="filterCollaborator[]"
                                            class="p-2.5 text-primary border border-gray-400 rounded-md focus:ring-primary cursor-pointer"
                                            value="{{ $item->id }}"
                                            onchange="document.getElementById('formFilter').submit();"
                                            {{ $filterCollaborator ? (in_array($item->id, $filterCollaborator) ? 'checked' : '') : '' }}>
                                        <span class="font-medium ml-4 text-neutral-800">{{ $item->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="hidden flex flex-col gap-y-5" id="hiddenCollaborators">
                                @foreach ($allCollaborators as $item)
                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" name="filterCollaborator[]"
                                            class="p-2.5 text-primary border border-gray-400 rounded-md focus:ring-primary cursor-pointer"
                                            value="{{ $item->id }}"
                                            onchange="document.getElementById('formFilter').submit();"
                                            {{ $filterCollaborator ? (in_array($item->id, $filterCollaborator) ? 'checked' : '') : '' }}>
                                        <span class="font-medium ml-4 text-neutral-800">{{ $item->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col py-6 border-b border-gray-200">
                        <p class="text-lg font-semibold text-gray-400 font-sans mb-6">Kategori</p>
                        <div class="flex flex-col gap-y-5">
                            @foreach ($experts as $expert)
                                <div class="flex flex-row items-center">
                                    <input type="checkbox" name="filterSector[]"
                                        class="p-2.5 text-primary border border-gray-400 rounded-md focus:ring-primary cursor-pointer"
                                        value="{{ $expert->name }}"
                                        onchange="document.getElementById('formFilter').submit();"
                                        {{ $filterSector ? (in_array($expert->name, $filterSector) ? 'checked' : '') : '' }}>
                                    <span class="font-medium ml-4 text-neutral-800">{{ $expert->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                <button id="show-all-button"
                    class="pr-4 text-primary lg:text-base lg font-medium cursor-pointer mb-6 absolute right-0 top-14"
                    onclick="showAllCollaborators()">Lihat Semua</button>
            </div>
            <div class="w-full flex flex-col lg:hidden mb-8">
                <div
                    class="flex flex-row items-center max-w-[calc(100vw-3rem)] overflow-x-hidden overflow-y-visible border-b-2 border-neutral-300 gap-x-4 mb-4">
                    <div class="w-fit {{ $isFiltered ? 'hidden' : 'flex' }} flex-row items-center text-neutral-800 pb-3 pr-2"
                        id="elLabelFilter">
                        <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 4C3 3.44772 3.44772 3 4 3H20C20.5523 3 21 3.44772 21 4V6.58579C21 6.851 20.8946 7.10536 20.7071 7.29289L14.2929 13.7071C14.1054 13.8946 14 14.149 14 14.4142V17L10 21V14.4142C10 14.149 9.89464 13.8946 9.70711 13.7071L3.29289 7.29289C3.10536 7.10536 3 6.851 3 6.58579V4Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="font-bold ml-2 text-lg"> Filter </span>
                    </div>
                    <a href="{{ route('mentors.index') }}"
                        class="w-fit {{ $isFiltered ? 'flex' : 'hidden' }} flex-row items-center text-neutral-800 pb-3 pr-2"
                        id="elResetFilter">
                        <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 4V9H4.58152M19.9381 11C19.446 7.05369 16.0796 4 12 4C8.64262 4 5.76829 6.06817 4.58152 9M4.58152 9H9M20 20V15H19.4185M19.4185 15C18.2317 17.9318 15.3574 20 12 20C7.92038 20 4.55399 16.9463 4.06189 13M19.4185 15H15"
                                stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="font-bold ml-2 text-base"> Reset Filter </span>
                    </a>
                    <div class="flex flex-row items-center overflow-x-auto overflow-y-visible no-scrollbar gap-x-4">
                        <a type="button" href="#" id="elBtnFilterCollaborator"
                            onclick="changeFilterMentor('collaborator')"
                            class="cursor-pointer tab text-neutral-800 hover:border-b-2 pb-3 hover:border-primary {{ isset($filterCollaborator) ? 'border-b-4 border-primary' : '' }}">Kolaborator</a>
                        <a type="button" href="#" id="elBtnFilterSector" onclick="changeFilterMentor('sector')"
                            class="cursor-pointer tab text-neutral-800 hover:border-b-2 pb-3 hover:border-primary {{ isset($filterSector) ? 'border-b-4 border-primary' : '' }}">Kategori</a>
                    </div>
                </div>
                <div class="{{ $isFiltered ? 'flex' : 'hidden' }} flex-row items-center max-w-[calc(100vw-3rem)] overflow-hidden"
                    id="elContentFilter">
                    <form method="GET" action="{{ route('mentors.index') }}"
                        class="flex flex-row items-center overflow-x-auto pb-3" id="formFilterMobile">
                        <div class="{{ isset($filterCollaborator) ? 'flex' : 'hidden' }} gap-x-1"
                            id="elFilterCollaborator">
                            @foreach ($collaborators as $collaborator)
                                <div class="flex flex-row items-center">
                                    <input type="checkbox" name="filterCollaborator[]"
                                        id="collaborator-{{ $collaborator->id }}" class="hidden"
                                        value="{{ $collaborator->id }}"
                                        onchange="document.getElementById('formFilterMobile').submit();">
                                    <label for="collaborator-{{ $collaborator->id }}"
                                        class="p-2 rounded-xl cursor-pointer  {{ isset($filterCollaborator) ? (in_array($collaborator->id, $filterCollaborator) ? 'bg-primary text-white' : 'bg-white text-neutral-800 border border-neutral-400') : 'bg-white text-neutral-800 border border-neutral-400' }}">
                                        <span
                                            class="font-medium whitespace-nowrap text-sm">{{ $collaborator->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="{{ isset($filterSector) ? 'flex' : 'hidden' }} gap-x-1" id="elFilterSector">
                            @foreach ($experts as $expert)
                                <div class="flex flex-row items-center">
                                    <input type="checkbox" name="filterSector[]" id="sector-{{ $expert->id }}"
                                        class="hidden" value="{{ $expert->name }}"
                                        onchange="document.getElementById('formFilterMobile').submit();">
                                    <label for="sector-{{ $expert->id }}"
                                        class="p-2 rounded-xl cursor-pointer  {{ isset($filterSector) ? (in_array($expert->name, $filterSector) ? 'bg-primary text-white' : 'bg-white text-neutral-800 border border-neutral-400') : 'bg-white text-neutral-800 border border-neutral-400' }}">
                                        <span class="font-medium whitespace-nowrap text-sm">{{ $expert->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
            {{-- Mentor --}}
            <div class="flex flex-col w-full lg:w-8/12">
                <p class="text-3xl text-primary font-semibold mb-6">Mentor</p>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-7">
                    @foreach ($mentors as $mentor_key => $mentor)
                        <div
                            class="flex flex-row gap-x-4 lg:gap-x-6 p-4 md:p-6 rounded-2xl shadow-xl w-full max-h-[356px]">
                            <div class="flex w-6/12">
                                <img class="w-full h-[280px] md:h-[300px] object-cover rounded mentor-photo-{{ $mentor_key }}"
                                    src="{{ $mentor->avatar_url ?? asset('images/avatar-boy.png') }}"
                                    onerror="this.src='{{ $mentor->gender == 'male' ? asset('images/avatar-boy.png') : asset('images/avatar-girl.png') }}'" />
                            </div>
                            <div class="flex flex-col w-6/12 max-h-[356px] gap-y-3 md:gap-y-4">
                                <div class="flex flex-row gap-2">
                                    <img class="w-8 h-8 object-contain" src="{{ $mentor->hasCollaborator->logo_url }}"
                                        alt="{{ $mentor->hasCollaborator->name }}"
                                        onerror="this.src='{{ asset('images/news/placeholder.png') }}'" />
                                    <p class="text-xs md:text-sm">{{ $mentor->hasCollaborator->name }}</p>
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="font-semibold text-base md:text-lg mentor-fullname-{{ $mentor_key }}">
                                        {{ $mentor->fullname }}</h4>
                                    <div
                                        class="flex gap-1 py-2 flex-wrap text-white text-lg mentor-expertise-{{ $mentor_key }}">
                                        @foreach ($mentor->hasExperts->take(2) as $expert)
                                            <span
                                                class="bg-secondary text-xs md:text-sm py-1 px-2 rounded-lg whitespace-nowrap">{{ $expert->name }}</span>
                                        @endforeach
                                    </div>
                                    <p
                                        class="text-[#6B7280] text-xs md:text-sm line-clamp-2 mentor-expertise-{{ $mentor_key }}">
                                        {{ $mentor->expertise }}</p>
                                </div>
                                <div class="flex flex-col w-full mt-auto">
                                    @auth
                                        @if (is_profile_updated())
                                            <button type="button"
                                                onclick="openModal({{ $mentor_key }}, {{ $mentor->id }})"
                                                class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block open-modal self-end">Konsultasi</button>
                                        @else
                                            <a href="{{ route('profile.edit', ['next_name' => 'mentors']) }}"
                                                class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                        @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}"
                                            class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if (!empty($mentors))
                    <div class="flex justify-center my-12">{{ $mentors->links('vendor.pagination.custom') }}</div>
                @endif
            </div>
        </div>

        <!-- Collaborator Section -->
        <div class="hidden lg:flex flex-col mb-20">
            <h3 class="text-3xl text-primary font-semibold mb-[72px]">Kolaborator</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-7 gap-y-8 mb-16">
                @foreach ($collaborators->take(3) as $collaborator_key => $collaborator)
                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
                        <img class="w-full max-h-[200px] object-cover" src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}"
                            alt="{{ $collaborator->name }}" />
                        <div class="flex flex-col px-5 py-6 flex-1">
                            <div class="flex flex-row gap-4 items-center mb-6">
                                <img class="w-12 h-12 object-cover" src="{{ $collaborator->logo_url }}"
                                    alt="{{ $collaborator->name }}" />
                                <h5 class="font-bold text-xl text-[#0F1010]">{{ $collaborator->name }}</h5>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col h-full justify-between">
                                    <div class="flex flex-col gap-2 mb-6">
                                        <div
                                            class="flex flex-wrap gap-2 text-white text-sm collaborator-hasTags-{{ $collaborator_key }}">
                                            @foreach ($collaborator->hasTags->take(2) as $tag)
                                                <span
                                                    class="bg-secondary md:text-sm py-1 px-2 rounded-lg whitespace-nowrap">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                        <div class="line-clamp-3">
                                            <p class="text-sm">{!! $collaborator->description !!}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'workshops']) }}"
                                        class="btn btn-lg btn-block btn-outline-primary">Lihat Detail Kolaborator</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('umkm.index') }}"
                class=" py-3 w-3/4 md:w-1/2 self-center flex flex-row items-center justify-center btn btn-lg btn-secondary">
                <span class="mr-3 text-center">Telusuri Kolaborator Lainnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 5L21 12M21 12L14 19M21 12H3" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>

        <div class="max-w-[calc(100vw-3rem)] sm:max-screen-sm block lg:hidden mt-8 mb-12">
            <div class="splide" id="collaborator-section">
                <h3 class="text-3xl text-primary font-semibold text-left ml-1">Kolaborator</h3>
                <div class="mt-6 pb-8">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($collaborators->take(3) as $collaborator_key => $collaborator)
                                <li class="splide__slide">
                                    <div
                                        class="flex flex-col rounded-2xl mx-2 my-6 overflow-hidden shadow-lg h-[calc(100%-3rem)]">
                                        <img class="w-full max-h-[200px] object-cover"
                                            src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}" alt="{{ $collaborator->name }}" />
                                        <div class="flex flex-col p-5 flex-1">
                                            <div class="flex flex-row gap-4 items-center mb-4">
                                                <img class="w-12 h-12 object-cover" src="{{ $collaborator->logo_url }}"
                                                    alt="{{ $collaborator->name }}" />
                                                <h5 class="font-bold text-lg text-[#0F1010]">{{ $collaborator->name }}
                                                </h5>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex flex-col h-full justify-between">
                                                    <div class="flex flex-col gap-2 mb-4">
                                                        <div
                                                            class="flex flex-wrap gap-2 py-1 text-white text-sm collaborator-hasTags-{{ $collaborator_key }}">
                                                            @foreach ($collaborator->hasTags->take(2) as $tag)
                                                                <span
                                                                    class="bg-secondary text-xs whitespace-nowrap py-1 px-2 rounded-lg">{{ $tag->name }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div class="line-clamp-9">
                                                            <p class="text-sm">{!! $collaborator->description !!}</p>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'workshops']) }}"
                                                        class="btn btn-lg btn-block btn-outline-primary">Lihat Detail
                                                        Kolaborator</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="splide__slide">
                                <div class="flex justify-center items-center h-[calc(100%-3rem)]">
                                    <a href="{{ route('umkm.index') }}"
                                        class="w-80 flex flex-row justify-center items-center self-center gap-2 btn btn-lg btn-outline-secondary">
                                        <span class="font-semibold">Telusuri Kolaborator Lainnya</span>
                                        <ion-icon name="arrow-forward-outline"
                                            class="text-secondary font-semibold"></ion-icon>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid gap-10 lg:grid-cols-2">
                <div class="flex items-center justify-center -mx-4 lg:pl-8 ">
                    <div class="flex flex-col items-end mr-4">
                        <img width="350px" src="{{ asset('images/logo-ehub-v2.png') }}">
                    </div>
                    <div class="">
                        <svg height="150" width="10">
                            <line x1="0" y1="0" x2="0" y2="280"
                                style="stroke:rgb(111, 111, 111);stroke-width:5" />
                        </svg>
                    </div>
                    <div class="px-3 mt-4">
                        <h2 class="text-xl text-primary font-bold mb-6 md:mb-8">
                            Mentor
                            <br>
                            Entrepreneur Hub
                        </h2>
                    </div>
                </div>
                <div class="flex flex-col justify-center md:pr-8 xl:pr-0 lg:max-w-lg">

                    <div class="max-w-xl mb-6 mr-5">
                        <h2 class="text-4xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Mentor</h2>
                        <p class="text-base md:text-lg text-medium mb-6">
                            Yuk! bergabung bersama kami menjadi mentor yang membantu entrepreneur dari seluruh Indonesia
                            untuk mengembangkan bisnisnya! Mari kita bersatu tangan untuk menciptakan ekosistem
                            kewirausahaan yang terkoneksi. Tunggu apa lagi? Bergabunglah bersama kami untuk berkontribusi
                            secara nyata dan wujudkan impian kita bersama!
                        </p>
                    </div>

                    <div class="flex justify-start items-center h-[calc(100%-3rem)] ">
                        <a href="http://bit.ly/FormMentorEhub"
                            class="w-65 mr-4 flex flex-row justify-center items-center self-center gap-2 btn btn-lg bg-secondary">
                            <span class="font-semibold text-white">Bergabung Sebagai Mentor</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        new Splide("#collaborator-section", {
            arrows: false,
            autoplay: true,
            interval: 4000,
            pagination: true,
            type: 'loop',
            fixedHeight: '620px',
            fixedWidth: '100%',
            interval: 3000,
            pauseOnHover: true,
            perPage: 2,
            breakpoints: {
                768: {
                    perPage: 1,
                },
            }
        }).mount();

        function showAllCollaborators() {
            const collaboratorContainer = document.getElementById('collaboratorContainer');
            const hiddenCollaborators = document.getElementById('hiddenCollaborators');
            const showAllButton = document.querySelector('#show-all-button');

            if (hiddenCollaborators.classList.contains('hidden')) {
                // Jika kolaborator terbaru sedang ditampilkan, tampilkan semua kolaborator
                hiddenCollaborators.querySelectorAll('.flex-row').forEach((collaboratorItem) => {
                    collaboratorItem.classList.remove('hidden');
                });

                // Sort kolaborator sesuai abjad
                const allCollaboratorItems = Array.from(hiddenCollaborators.querySelectorAll('.flex-row'));
                allCollaboratorItems.sort((a, b) => {
                    const nameA = a.querySelector('.text-neutral-800').textContent.trim().toUpperCase();
                    const nameB = b.querySelector('.text-neutral-800').textContent.trim().toUpperCase();
                    return nameA.localeCompare(nameB);
                });

                collaboratorContainer.innerHTML = ''; // Menghapus isi container
                allCollaboratorItems.forEach((collaboratorItem) => {
                    collaboratorContainer.appendChild(collaboratorItem);
                });

                showAllButton.style.display = 'none';
            } else {
                // Jika semua kolaborator ditampilkan, sembunyikan 5 kolaborator terbaru
                hiddenCollaborators.querySelectorAll('.flex-row').forEach((collaboratorItem, index) => {
                    if (index < 5) {
                        collaboratorItem.classList.add('hidden');
                    }
                });

            }
        }
        // function for modal consultation
        const modalConsult = document.querySelector('#modalConsultation');
        var overlay = document.querySelector('.overlay');
        var closeModalBtnConsult = document.querySelector('.close-modal');
        var content = document.querySelector('.content');

        function openModal(key, id) {
            let mentorFullname = document.querySelector('.mentor-fullname-' + key).textContent;
            let mentorExpertise = document.querySelector('.mentor-expertise-' + key).textContent;
            let mentorPhoto = document.querySelector('.mentor-photo-' + key).src;
            modalConsult.querySelector('.consultation-mentor-id').value = id;
            modalConsult.querySelector('.consultation-mentor-photo').src = mentorPhoto;
            modalConsult.querySelector('.consultation-mentor-fullname').textContent = mentorFullname;
            modalConsult.querySelector('.consultation-mentor-expertise').textContent = mentorExpertise;
            modalConsult.classList.remove('hidden');
            modalConsult.classList.add('flex');
            modalConsult.classList.add('two');
            content.classList.add('modal-active');
        }
        const closeModal = function() {
            modalConsult.classList.remove('flex');
            content.classList.remove('modal-active');
            modalConsult.classList.add('hidden');
        };
        closeModalBtnConsult.addEventListener("click", closeModal);
        overlay.addEventListener("click", closeModal);

        const elFormFilterMobile = {
            contentFilter: document.getElementById('elContentFilter'),
            btnFilterCollaborator: document.getElementById('elBtnFilterCollaborator'),
            btnFilterSector: document.getElementById('elBtnFilterSector'),
            filterCollaborator: document.getElementById('elFilterCollaborator'),
            filterSector: document.getElementById('elFilterSector')
        }

        var isActiveFilterCollaborator = {{ isset($filterCollaborator) ? 1 : 0 }};
        var isActiveFilterSector = {{ isset($filterSector) ? 1 : 0 }};

        function changeFilterMentor(type) {
            elFormFilterMobile.filterCollaborator.classList.remove('flex', 'hidden');
            elFormFilterMobile.filterSector.classList.remove('flex', 'hidden');
            elFormFilterMobile.contentFilter.classList.remove('hidden');
            elFormFilterMobile.contentFilter.classList.add('flex');
            if (type == 'collaborator') {
                elFormFilterMobile.filterSector.classList.add('hidden');
                elFormFilterMobile.btnFilterSector.classList.remove('border-b-4', 'border-primary');
                isActiveFilterSector = false;
                if (isActiveFilterCollaborator) {
                    elFormFilterMobile.filterCollaborator.classList.add('hidden');
                    isActiveFilterCollaborator = false;
                } else {
                    elFormFilterMobile.filterCollaborator.classList.remove('hidden');
                    elFormFilterMobile.filterCollaborator.classList.add('flex');
                    isActiveFilterCollaborator = true;
                }
            } else if (type == 'sector') {
                elFormFilterMobile.filterCollaborator.classList.add('hidden');
                elFormFilterMobile.btnFilterCollaborator.classList.remove('border-b-4', 'border-primary');
                isActiveFilterCollaborator = false;
                if (isActiveFilterSector) {
                    elFormFilterMobile.filterSector.classList.add('hidden');
                    isActiveFilterSector = false;
                } else {
                    elFormFilterMobile.filterSector.classList.remove('hidden');
                    elFormFilterMobile.filterSector.classList.add('flex');
                    isActiveFilterSector = true;
                }
            } else {
                elFormFilterMobile.filterCollaborator.classList.add('hidden');
                elFormFilterMobile.filterSector.classList.add('hidden');
            }
        }
    </script>
@endsection
