@extends('landing.layouts.app')
@section('extra-title') Program Kewirausahaan @endsection
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

        #news-section .splide__arrow--next {
            right: -0.4rem;
        }

        #news-section .splide__arrow--prev {
            left: -0.4rem;
        }
    </style>
@endsection
@section('page-title')
  <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
    <h1 class="text-white">Program Kewirausahaan</h1>
  </div>
@endsection
@section('content')
    <div class="flex flex-col w-full px-2 md:px-4">
        {{-- Section search --}}
        <div class="flex flex-row items-center justify-center py-8 md:py-16 w-full">
            <form class="flex flex-row items-center w-full md:w-9/12" action="{{ route('workshops.index') }}" method="GET">
                <div class="relative flex flex-1 mr-3 md:mr-6">
                    <svg class="absolute top-2 md:top-2.5 ml-2 md:ml-4 w-6 h-6 md:w-8 md:h-8" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_248_3601)">
                            <path d="M21.1665 18.6667H20.1132L19.7399 18.3067C21.3399 16.44 22.1665 13.8933 21.7132 11.1867C21.0865 7.48001 17.9932 4.52001 14.2599 4.06668C8.61986 3.37334 3.87319 8.12001 4.56652 13.76C5.01986 17.4933 7.97986 20.5867 11.6865 21.2133C14.3932 21.6667 16.9399 20.84 18.8065 19.24L19.1665 19.6133V20.6667L24.8332 26.3333C25.3799 26.88 26.2732 26.88 26.8199 26.3333C27.3665 25.7867 27.3665 24.8933 26.8199 24.3467L21.1665 18.6667ZM13.1665 18.6667C9.84652 18.6667 7.16652 15.9867 7.16652 12.6667C7.16652 9.34668 9.84652 6.66668 13.1665 6.66668C16.4865 6.66668 19.1665 9.34668 19.1665 12.6667C19.1665 15.9867 16.4865 18.6667 13.1665 18.6667Z" fill="#4B5563"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_248_3601">
                                <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <input type="text" class="rounded-xl border border-gray-400 pl-10 md:pl-16 py-2 md:py-3 text-sm md:text-base placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600" name="search" placeholder="Cari berdasarkan judul dan pelaksana" value="{{ request()->input('search') }}" />
                </div>
                <button type="submit" class="px-5 md:px-7 py-2 md:py-3 text-sm md:text-base font-semibold border border-primary bg-primary rounded-xl text-white"><span class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Program</span></button>
            </form>
        </div>
        {{-- Section program --}}
        <div class="flex flex-col py-6 w-full gap-x-8 mb-24">
            <h3 class="text-2xl font-bold mb-3">Program Kewirausahaan terkini</h3>
            <p class="text-base md:text-lg font-medium text-gray-600 mb-8 md:mb-12">EntrepreneurHub merupakan Platform Ekosistem Wirausaha Indonesia yang mengintegrasikan berbagai kementerian/Lembaga dan Pemangku Kepentingan serta Pelaku UMKM. </p>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-7 gap-y-9">
                @foreach($workshops->slice(0, 12) as $workshop)
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
                                    <div class="flex flex-wrap gap-1 py-4">
                                        @foreach($workshop->hasTags as $tag)
                                        <span class=" bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="font-bold text-base md:text-xl mb-4">{{ $workshop->title }}</h4>
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
        </div>
        {{-- Section bawah --}}
        <div class="-mx-[40px] md:-mx-[76px] py-[72px] hidden lg:block">
            <div class="px-[40px] md:px-[76px]">
                <h3 class="font-bold text-3xl text-[#0F1010] mb-8">Kabar Terkini</h3>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
                    @foreach($news->slice(0, 4) as $news_item)
                    <a href="{{ route('news.detail', $news_item->slug) }}">
                        <div class="md:flex rounded-xl shadow-xl">
                            <img class="w-full md:w-48 h-40 md:h-auto rounded-l-xl mx-auto object-cover" src="{{ $news_item->url_thumbnail ?? asset('images/ehub-cover.png') }}" 
                                alt="{{ $news_item->title }}" onerror="this.src='{{ asset('images/ehub-cover.png') }}'"/>
                            <div class="px-6 py-3 text-left space-y-4 w-full">
                                <div class="flex flex-col gap-3 h-full justify-between">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($news_item->hasTags->take(2) as $tag)
                                    <span class="text-[#9CA3AF]">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news_item->title }}</h5>
                                <div class="line-clamp-3">
                                    <p class="text-gray-700 font-medium">{!! $news_item->content !!}</p>
                                </div>
                                <span class="text-[#9CA3AF]">{{ format_date($news_item->created_at, 'D MMMM Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
                <div class="flex justify-center items-center">
                    <a href="{{ route('news.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-primary">
                        <span class="font-semibold">Cek kabar lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-white font-semibold"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-[calc(100vw-2.5rem)] sm:max-screen-sm splide block lg:hidden">
            <div class="splide" id="news-section">
                <div class="flex flex-col items-center gap-6">
                    <h3 class="text-primary text-3xl text-center font-semibold">Kabar Terkini</h3>
                </div>
                <div class="mt-10">
                    <div class="splide__track">
                        <ul class="splide__list">
                        @foreach($news->take(3) as $key => $news_item)
                            <li class="splide__slide">
                                <a href="{{ route('news.detail', $news_item->slug) }}" class="flex flex-col rounded-2xl mx-3 my-6 overflow-hidden shadow-lg h-[calc(100%-3rem)]">
                                    <img class="w-full max-h-[200px] object-cover" src="{{ $news_item->url_thumbnail }}" alt="{{ $news_item->title }}" />
                                    <div class="flex flex-col px-5 py-6 flex-1">
                                        <div class="flex flex-col h-full justify-between">
                                            <div class="flex flex-col gap-2 mb-4">
                                                <div class="flex gap-2 py-1 text-white text-sm news-hasTags-{{ $key }}">
                                                    @foreach ($news_item->hasTags->take(2) as $tag)
                                                        <span class="bg-secondary text-sm py-1 px-2 rounded-lg">{{ $tag->name }}</span>
                                                    @endforeach
                                                </div>
                                                <h5 class="font-bold text-xl text-[#0F1010]">{{ $news_item->title }}</h5>
                                                <div class="line-clamp-3">
                                                    <p class="text-gray-700 font-medium">{!! $news_item->content !!}</p>
                                                </div>
                                            </div>
                                            <span class="text-[#9CA3AF]">{{ format_date($news_item->created_at, 'd M Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-8">
                    <a href="{{ route('news.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
                        <span class="font-semibold">Cek kabar lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-white font-semibold"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
    new Splide("#news-section", {
            arrows: true,
            autoplay: true,
            interval: 4000,
            pagination:true,
            type: 'loop',
            fixedHeight : '540px',
            fixedWidth : '100%',
            interval: 3000,
            pauseOnHover: true,
            perPage: 1,
        }).mount();
    </script>
@endsection
