@extends('landing.layouts.app')
@section('extra-title')
    Detail Kabar
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

        #program-section .splide__arrow--next {
            right: -0.4rem;
        }

        #program-section .splide__arrow--prev {
            left: -0.4rem;
        }
    </style>
@endsection
@section('content')
    <hr class="max-md:hidden" />
    <div class="flex flex-col mt-6 w-full ">
        <div class="flex md:items-center items-start max-tablet-a51:hidden">
            <a href="/" class="text-sm font-normal text-gray-500 mr-1">Home</a>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <a href="/news" class="text-sm font-normal text-gray-500 mx-1">Kabar</a>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <a href="#" class="text-sm font-normal text-gray-800 ml-1">{{ $news_item->title }}</a>
        </div>
        {{-- Section detail kabar --}}
        <div class="flex gap-8 w-full mb-20 py-6">
            <div class="flex flex-col rounded-2xl">
                <img class="w-auto max-h-[500px] object-cover rounded-2xl" src="{{ $news_item->url_thumbnail ?? asset('images/ehub-cover.png') }}" onerror="this.src='{{ asset('images/ehub-cover.png') }}'" />
                <div class="flex flex-row max-xl:flex-col gap-7">
                    <div class="flex flex-col gap-4 py-10 w-8/12 max-xl:w-full">
                        <div class="flex flex-row gap-3 items-center">
                            @foreach ($news_item->hasTags as $tag)
                                <p class="text-gray-400 py-1 px-4 rounded-xl bg-gray-200 font-medium">{{ $tag->name }}
                                </p>
                            @endforeach
                        </div>
                        <p class="font-bold text-2xl text-gray-900">{{ $news_item->title }}</p>
                        <div class="flex gap-4 items-center">
                            <img class="w-[32px] rounded-full"
                                src="{{ $news_item->hasUser->hasCollaborator ? $news_item->hasUser->hasCollaborator->logo_url : asset('images/logo-enterpreneurhub-old.png') }}">
                            <?php
                            $collaboratorName = null;
                            if ($news_item->hasUser) {
                                $collaborator = $news_item->hasUser->hasCollaborator;
                                if ($collaborator) {
                                    $collaboratorName = $collaborator->name;
                                    $displayedName = strpos($collaboratorName, 'Admin') === false ? 'Admin ' . $collaboratorName : $collaboratorName;
                                } else {
                                    $displayedName = 'Admin Ehub';
                                }
                            }
                            ?>
                            <p class="text-gray-700 font-semibold text-xl"><b>{{ $displayedName }}</b> -
                                {{ format_date($news_item->created_at, 'D MMMM Y') }}</p>
                        </div>
                        {{-- isi artikel --}}
                        <div class="html-content flex-col flex font-normal text-base text-gray-600 gap-6">
                            <p class="text-gray-800 font-bold">{{ $news_item->title }}</p>
                            {!! $news_item->content !!}
                        </div>
                        <div class="text-xl font-semibold text-gray-700 mt-6">Share:</div>
                        <div class="flex gap-4">
                            <a id="facebookShare" href="#" target="_blank" rel="noopener noreferrer"><img
                                    class="w-[32px] rounded-full cursor-pointer"
                                    src="{{ asset('images/news/icon-fb.png') }}"></a>
                            <a id="twitterShare" href="#" target="_blank" rel="noopener noreferrer"><img
                                    class="w-[32px] rounded-full cursor-pointer"
                                    src="{{ asset('images/news/icon-twitter.png') }}"></a>
                            <a id="copyButton"><img class="w-[32px] rounded-full cursor-pointer"
                                    src="{{ asset('images/news/icon-link.png') }}"></a>
                        </div>
                    </div>

                    {{-- Section Terpopuler --}}
                    <div class="flex flex-col py-10 gap-6 w-4/12 max-xl:hidden">
                        <div class="text-gray-600 text-xl font-semibold">Sedang Ramai:</div>
                        @foreach ($populars->slice(0, 4) as $i)
                            <div class="flex-col flex font-normal text-base text-gray-600 gap-2">
                                <a href="{{ route('news.detail', $i->slug) }}"
                                    class="text-gray-800 text-xl font-bold">{{ $i->title }}</a>
                                <div class="line-clamp-2">
                                    <p class="text-gray-600 text-base">{!! $i->content !!}</p>
                                </div>
                                <div class="flex cursor-pointer items-center gap-2">
                                    <a href="{{ route('news.detail', $i->slug) }}"
                                        class="text-secondary text-lg font-semibold">Baca Selengkapnya</a>
                                    <ion-icon name="arrow-forward" class="text-secondary" size="small"></ion-icon>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- Section kabar terkini --}}
        @if (count($relatedNews) > 0)
            <div class="flex flex-col mb-20">
                <h3 class="text-2xl font-bold mb-8 text-gray-700">Kabar Terkait</h3>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-7 gap-y-8 mb-16">
                    @foreach ($relatedNews as $i)
                        <a href="{{ route('news.detail', $i->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg ">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ $i->url_thumbnail ?? asset('images/ehub-cover.png') }}" onerror="this.src='{{ asset('images/ehub-cover.png') }}'"/>
                                </div>
                                <div class="flex flex-col py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($i->hasTags as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="cursor-pointer font-semibold text-xl text-gray-900 line-clamp-2">
                                        {{ $i->title }}</h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $i->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">{{ format_date($i->created_at, 'D MMMM Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        {{-- Section program --}}
        <div class="flex flex-col py-6 w-full gap-x-8 mb-24">
            <h3 class="text-3xl font-bold mb-8 max-md:mb-4 text-center"
                style="background: linear-gradient(264.5deg, #9DA960 -1.16%, #7EA086 62.37%, #2C5165 96.11%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;">
                Program-Program EntrepreneurHub</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-7 gap-y-9 mb-16 max-lg:hidden">
                @foreach ($workshops->slice(0, 2) as $workshop)
                    <div class="flex flex-col xl:hidden rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6">
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
                @foreach ($workshops->slice(0, 3) as $workshop)
                    <div class="flex flex-col max-xl:hidden rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6">
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
                                    <div class="flex flex-wrap gap-1 py-4">
                                        @foreach ($workshop->hasTags as $tag)
                                            <span
                                                class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="font-bold text-base md:text-xl mb-4">{{ $workshop->title }}</h4>
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
            <div class="max-sm:mx-auto max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl splide visible lg:hidden"
                id="program-section">
                <div class="mt-6 md:mt-10">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($workshops as $workshop)
                                <li class="splide__slide">
                                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl p-4 md:p-6">
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
                                                    <div class="flex flex-wrap gap-1 py-4">
                                                        @foreach ($workshop->hasTags as $tag)
                                                            <span
                                                                class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                                        @endforeach
                                                    </div>
                                                    <h4 class="font-bold text-base md:text-xl mb-4">{{ $workshop->title }}
                                                    </h4>
                                                </div>
                                                <div>
                                                    <div
                                                        class="flex flex-row items-center gap-2 mb-3 md:mb-4 text-xs md:text-sm">
                                                        <ion-icon name="calendar-outline"
                                                            class="text-[#9CA3AF]"></ion-icon>
                                                        <span
                                                            class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }}
                                                            WIB</span>
                                                    </div>
                                                    <a href="{{ route('workshops.detail', $workshop->slug) }}"
                                                        class="btn btn-lg btn-primary btn-block text-sm md:text-base">Lihat
                                                        Program</a>
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
            <a href="{{ route('workshops.index') }}"
                class="border border-secondary text-secondary rounded-xl py-3 w-3/4 md:w-1/2 self-center flex flex-row items-center justify-center mt-4">
                <span class="mr-3 text-center text-lg font-sembibold">Cek Program Lainnya</span>
                <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
            </a>
        </div>
        {{-- Section bawah --}}
    </div>
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
        const copyButton = document.getElementById('copyButton');

        copyButton.addEventListener('click', () => {
            const url = window.location.href;

            navigator.clipboard.writeText(url)
                .then(() => {
                    alert('URL berhasil disalin!');
                })
                .catch((error) => {
                    console.error('Gagal menyalin URL:', error);
                });
        });
        new Splide("#program-section", {
            autoplay: true,
            pagination: false,
            type: 'loop',
            perMove: 1,
            gap: '1.5rem',
            perPage: 3,
            breakpoints: {
                1024: {
                    perPage: 1,
                }
            }
        }).mount();
    </script>
    <script>
        var currentUrl = window.location.href;
        var facebookShareLink = document.getElementById('facebookShare');
        var twitterShareLink = document.getElementById('twitterShare');

        facebookShareLink.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl);
        twitterShareLink.href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentUrl) +
            '&text=Kunjungi%20Entrepreneur%20Hub%20Disini%20Sekarang%21';
    </script>
@endsection
