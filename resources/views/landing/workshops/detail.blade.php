@extends('landing.layouts.app')
@section('extra-title') Detail Program @endsection
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
    </style>
@endsection
@section('content')
<hr class="max-md:hidden"/>
<section class="mt-6">
<div class="flex md:items-center items-start">
    <a href="/" class="text-sm font-normal text-gray-500 mr-1">Home</a>
    <ion-icon name="chevron-forward-outline"></ion-icon>
    <a href="/workshops" class="text-sm font-normal text-gray-500 mx-1">Program</a>
    <ion-icon name="chevron-forward-outline"></ion-icon>
    <a href="#" class="text-sm font-normal text-gray-800 ml-1">{{ $workshop->title }}</a>
</div>
<div class="flex flex-col xl:flex-row mt-2">
    <div class="flex flex-col w-8/12 max-xl:w-full pr-7 max-xl:pr-0">
        <div class="flex flex-col md:flex-row items-start w-full gap-2 mt-7">
            @forelse ($workshop->hasCollaborators as $workshopCollaborator)
                <div class="flex flex-row items-center gap-2 ">
                    <img class="w-auto h-8 object-contain" src="{{ $workshopCollaborator->logo_url ?? asset('images/logo-ehub-new.png')  }}" alt="Logo {{ $workshopCollaborator->name }}" />
                    <span>{{ $workshopCollaborator->name ?? 'EntrepreneurHub' }}</span>
                    @if (!$loop->last)
                        <span class="mx-2 md:flex hidden">|</span>
                    @endif
                </div>
            @empty
                <div class="flex flex-row items-center gap-2">
                    <img class="w-auto h-8 object-contain" src="{{ asset('images/logo-ehub-new.png') }}" alt="Logo EntrepreneurHub" />
                    <span>EntrepreneurHub</span>
                </div>
            @endforelse
        </div>
        <div class="flex ">
            <p class="bg-gray-200 rounded-3xl py-1 px-4 mt-5 w-shrink text-xs mb-3">Akses Pasar & Fasilitas Infrastruktur</p>
        </div>
        <div class="flex">
            <p class="text-2xl font-bold mb-3">{{ $workshop->title }}</p>
        </div>
        <div class="flex flex-row items-start max-md:flex-col justify-start">
            @if($workshop->place == 'online')
                <div class="flex text-white bg-[#E11D48] py-1 px-2 rounded-3xl font-[12px] items-center mr-8">
                    <ion-icon name="videocam-outline" class="mr-2" size="large"></ion-icon>Online events
                </div>
            @else
                <div class="flex flex-row items-center py-1 px-2 gap-2 text-[#4B5563]">
                    <ion-icon name="map-outline" size="large"></ion-icon>
                    <span>{{ $workshop->hasCity ? $workshop->hasCity->city_name : '' }}</span>
                </div>
            @endif
            <div class="flex text-slate-600 py-1 px-2 font-[12px] items-center">
                <ion-icon name="calendar-clear-outline" class="mr-2"  size="large" color="gray-600"></ion-icon>{{ format_date($workshop->start_date, 'D MMMM Y') }}
            </div>
            <div class="flex text-slate-600 py-1 px-2 font-[12px] items-center ">
                <ion-icon name="time-outline" class="mr-2"  size="large" color="gray-600"></ion-icon>{{ format_date($workshop->start_time, 'HH:mm') }} - {{ format_date($workshop->end_time, 'HH:mm') }} WIB
            </div>
        </div>
        <div class="flex mt-6">
            <p class="text-base font-bold">Deskripsi Program</p>
        </div>
        <div class="html-content flex flex-col mt-3">
            {!! $workshop->description !!}
        </div>
        <div class="flex mt-8">
            <p class="text-base font-bold">Diperuntukkan</p>
        </div>
        <div class="flex mt-3 ml-6">
            <ul class="list-disc">
                @foreach($workshop->hasTargets as $target)
                <li>{{ $target->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="flex flex-1 flex-col rounded-2xl overflow-hidden shadow-2xl h-full mt-16 xl:mt-0">
        <img id="open-modal-image" class="w-full h-[200px] md:h-[240px] mx-auto object-cover rounded cursor-pointer" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" onClick="openModalImage(this)" />
        <div class="px-6 pt-6 pb-8 flex-1">
        <div class="flex flex-col">
            <div class="flex flex-col items-start">
            <div class="flex flex-row items-center gap-2">
                <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                <span>{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
            </div>
            <div class="flex flex-wrap gap-3 py-4">
                @foreach($workshop->hasTags as $tag)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                @endforeach
            </div>
            <h4 class="font-bold text-xl mb-2">{{ $workshop->title }}</h4>
            </div>
            <div>
            <div class="flex flex-row items-center gap-2 mb-6 text-sm">
                <ion-icon name="calendar-outline" class="text-[#9CA3AF]"></ion-icon>
                <span class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }} WIB</span>
            </div>
            @if($is_registered)
                @if($is_contacted)
                <button type="button" class="btn btn-lg btn-primary btn-block !bg-[#8ea8b1] cursor-not-allowed">Telah Terdaftar</button>
                @else
                <button type="button" class="btn btn-lg btn-primary btn-block !bg-[#8ea8b1] cursor-not-allowed">Menunggu Konfirmasi</button>
                @endif
            @else
                @if(is_profile_updated())
                <form action="{{ route('workshops.follow', $workshop->slug) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Ikuti Program</button>
                </form>
                @else
                <a href="{{ route('profile.edit', ['next_name' => 'workshops', 'next_value' => $workshop->slug]) }}" class="btn btn-lg btn-primary btn-block">Ikuti Program</a>
                @endif
            @endif
            </div>
        </div>
        </div>
    </div>
</div>
</section>

<section class="mb-20 mt-[150px]">
<h3 class="text-primary text-4xl text-center font-semibold">Program EntrepreneurHub</h3>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-7 py-[72px] max-lg:hidden">
    @foreach($workshops->slice(0, 3) as $workshop)
        <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6">
            <div class="flex flex-1">
                <img class="w-full h-[200px] md:h-[240px] mx-auto object-cover rounded" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" onerror="this.src='{{ asset('images/news/placeholder.png') }}'"/>
            </div>
            <div class="pt-4 flex-1">
                <div class="flex flex-col h-full justify-between">
                    <div class="flex flex-col items-start">
                        <div class="flex flex-row items-center gap-2">
                            <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                            <span class="text-xs md:text-sm">{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1 py-2">
                            @foreach($workshop->hasTags as $tag)
                            <span class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <h4 class="font-bold text-base md:text-xl mb-2">{{ $workshop->title }}</h4>
                    </div>
                    <div>
                        <div class="flex flex-row items-center gap-2 mb-3 md:mb-4 text-xs md:text-sm">
                            <ion-icon name="calendar-outline" class="text-[#9CA3AF]"></ion-icon>
                            <span class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }} WIB</span>
                        </div>
                        <a href="{{ route('workshops.detail', $workshop->slug) }}" class="btn btn-lg btn-primary btn-block text-sm md:text-base">Lihat Program</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="max-sm:mx-auto max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl p-4 sm:p-6 md:p-8 lg:p-10 xl:p-10 splide visible lg:hidden" id="program-section">
    <div class="mt-6 md:mt-10">
        <div class="splide__track">
            <ul class="splide__list">
            @foreach($workshops->slice(0, 3) as $workshop)
                <li class="splide__slide">
                <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6">
                    <div class="flex flex-1">
                        <img class="w-full h-[200px] md:h-[240px] mx-auto object-cover rounded" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" onerror="this.src='{{ asset('images/news/placeholder.png') }}'"/>
                    </div>
                    <div class="pt-4 flex-1">
                        <div class="flex flex-col h-full justify-between">
                            <div class="flex flex-col items-start">
                                <div class="flex flex-row items-center gap-2">
                                    <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                                    <span class="text-xs md:text-sm">{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
                                </div>
                                <div class="flex flex-wrap gap-1 py-2">
                                    @foreach($workshop->hasTags as $tag)
                                    <span class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <h4 class="font-bold text-base md:text-xl mb-2">{{ $workshop->title }}</h4>
                            </div>
                            <div>
                                <div class="flex flex-row items-center gap-2 mb-3 md:mb-4 text-xs md:text-sm">
                                    <ion-icon name="calendar-outline" class="text-[#9CA3AF]"></ion-icon>
                                    <span class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }} WIB</span>
                                </div>
                                <a href="{{ route('workshops.detail', $workshop->slug) }}" class="btn btn-lg btn-primary btn-block text-sm md:text-base">Lihat Program</a>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="flex justify-center items-center ">
    <a href="{{ route('workshops.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center border border-secondary rounded-2xl items-center gap-2 btn btn-lg btn-outline-secondary">
        <span class="font-semibold">Telusuri Program Lainnya</span>
        <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
    </a>
</div>
</section>

<!-- Modal container -->
<div id="modal-display-image" class="hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-70  z-50">

    <button id="close-modal-button" class="absolute top-0 right-0 p-4 text-white" onClick="closeModalImage()">
        X
    </button>

    <!-- Image preview inside the modal -->
    <img
        id="image-preview"
        src=""
        alt="Modal Image Preview"
        class="max-w-full max-h-full xl:p-24 lg:p-20 md:p-16 max-md:p-8"
    />
</div>
@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<script>

new Splide("#program-section", {
    autoplay: true,
    pagination: false,
    type: 'loop',
    perMove: 1,
    gap: '1.5rem',
    perPage: 3,
    breakpoints: {
        1024: {
        perPage: 2,
        },
        768: {
            perPage: 1
        },
    }
}).mount();

    const $modalImage = document.querySelector('#modal-display-image');
    const $openModalImage = document.querySelector('#open-modal-image');
    const $imagePreview = document.querySelector('#image-preview');

    function openModalImage(event) {
        $imagePreview.src = event.src;
        $modalImage.classList.remove('hidden');
        $modalImage.classList.add('flex');
    }

    document.addEventListener('click', (event) => {
        const isInside = $openModalImage.isSameNode(event.target) || $imagePreview.isSameNode(event.target);
        if (!isInside) {
            $modalImage.classList.add('hidden');
            $modalImage.classList.remove('flex');
        }
    });
</script>
@endsection
