@extends('landing.layouts.app')
@section('extra-title')
    Kabar Terkini
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

@section('page-title')
    <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
        <h1 class="text-white">Kabar Terkini</h1>
    </div>
@endsection

@section('content')
    <div class="flex flex-col w-full">
        {{-- Section search --}}
        <div class="flex flex-row items-center justify-center py-5 max-md:mt-6 md:py-16 w-full ">
            <form class="flex flex-row items-center w-full md:w-9/12" action="{{ route('news.index') }}" method="GET">
                <div class="relative flex flex-1 mr-6">
                    <svg class="absolute top-2.5 ml-4" width="33" height="32" viewBox="0 0 33 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
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
                        class="rounded-xl border border-gray-400 pl-16 py-3 placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600"
                        name="search" placeholder="Cari berdasarkan judul" value="{{ request()->input('search') }}" />
                </div>
                <button type="submit"
                    class="px-5 md:px-7 py-2 md:py-3 text-sm md:text-base font-semibold border border-primary bg-primary rounded-xl text-white"><span
                        class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Kabar</span></button>
            </form>
        </div>

        @if (!request()->has('search'))
            @if ($nextNews->currentPage() > 1)
                <h3 class="text-2xl font-bold mb-8 text-gray-700">Kabar Terbaru</h3>
            @endif
            <div class="flex  {{ $nextNews->currentPage() > 1 ? 'mb-20' : 'mb-4' }} py-9 ">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 w-full">
                    <a href="{{ route('news.detail', $news[0]->slug) }}">
                        <div class="flex flex-col rounded-2xl shadow-lg">
                            <div class="flex w-full">
                                <img class="w-full h-full object-cover rounded-t-2xl"
                                    src="{{ asset($news[0]->url_thumbnail) }}">
                            </div>
                            <div class="flex flex-col py-8 px-7 w-full ">
                                <div class="flex gap-2">
                                    @foreach ($news[0]->hasTags->take(1) as $tag)
                                        <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                    @endforeach
                                </div>
                                <h5 class="text-[#111827] text-xl font-semibold mb-6 line-clamp-2">{{ $news[0]->title }}
                                </h5>
                                <div class="line-clamp-6">
                                    <p class="text-gray-700 font-medium mb-3">{!! $news[0]->content !!}</p>
                                </div>
                                <p class="text-gray-400 font-medium mt-4">
                                    {{ format_date($news[0]->created_at, 'D MMMM Y') }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="flex flex-col gap-y-6 justify-between">
                        <a href="{{ route('news.detail', $news[1]->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg ">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ asset($news[1]->url_thumbnail) }}">
                                </div>
                                <div class="flex flex-col flex-1 py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($news[1]->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold mb-2 line-clamp-2">
                                        {{ $news[1]->title }}</h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium">{!! $news[1]->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news[1]->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('news.detail', $news[2]->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg ">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ asset($news[2]->url_thumbnail) }}">
                                </div>
                                <div class="flex flex-col flex-1 py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($news[2]->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news[2]->title }}
                                    </h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $news[2]->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news[2]->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('news.detail', $news[3]->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ asset($news[3]->url_thumbnail) }}">
                                </div>
                                <div class="flex flex-col flex-1 py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($news[3]->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news[3]->title }}
                                    </h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $news[3]->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news[3]->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col mb-6 ">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-7 gap-y-8 mb-16">
                    @forelse($news as $news_item)
                        <a href="{{ route('news.detail', $news_item->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ $news_item->url_thumbnail ?? asset('images/ehub-cover.png') }}" onerror="this.src='{{ asset('images/ehub-cover.png') }}'" />
                                </div>
                                <div class="flex flex-col py-3 px-6 w-full md:w-8/12 ">
                                    <div class="flex gap-2">
                                        @foreach ($news_item->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news_item->title }}
                                    </h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $news_item->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news_item->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-2 text-center">Kabar tidak ditemukan</div>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- Section kabar terbaru --}}
        <div class="flex flex-col mb-20">
            @if ($nextNews->currentPage() > 1)
                <h3 class="text-2xl font-bold mb-8 text-gray-700">Kabar Entrepreneur Hub</h3>
            @endif
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-7 gap-y-8 mb-16">
                @if ($nextNews->currentPage() === 1)
                    @foreach ($nextNews->slice(4) as $news_next)
                        <a href="{{ route('news.detail', $news_next->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ $news_next->url_thumbnail ?? asset('images/ehub-cover.png') }}"
                                        onerror="this.src='{{ asset('images/ehub-cover.png') }}'" />
                                </div>
                                <div class="flex flex-col py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($news_next->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news_next->title }}
                                    </h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $news_next->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news_next->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach ($nextNews as $news_next)
                        <a href="{{ route('news.detail', $news_next->slug) }}">
                            <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg">
                                <div class="flex w-full md:w-4/12">
                                    <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                        src="{{ $news_next->url_thumbnail ?? asset('images/ehub-cover.png') }}"
                                        onerror="this.src='{{ asset('images/ehub-cover.png') }}'" />
                                </div>
                                <div class="flex flex-col py-3 px-6 w-full md:w-8/12">
                                    <div class="flex gap-2">
                                        @foreach ($news_next->hasTags->take(1) as $tag)
                                            <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                        @endforeach
                                    </div>
                                    <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news_next->title }}
                                    </h5>
                                    <div class="line-clamp-3">
                                        <p class="text-gray-700 font-medium mb-3">{!! $news_next->content !!}</p>
                                    </div>
                                    <p class="text-gray-400 font-medium mt-3">
                                        {{ format_date($news_next->created_at, 'D MMMM Y') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="flex justify-center mb-2 lg:mb-10">
                {{ $nextNews->links('vendor.pagination.custom-2') }}
            </div>
        </div>


        {{-- Section kabar terpopuler --}}
        <div class="flex flex-col mb-20 ">
            <h3 class="text-2xl font-bold mb-8 text-gray-700">Kabar Terpopuler</h3>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-7 gap-y-8 mb-16">
                @foreach ($populars as $popular)
                    <a href="{{ route('news.detail', $popular->slug) }}">
                        <div class="flex flex-col md:flex-row w-full rounded-2xl bg-white shadow-lg">
                            <div class="flex w-full md:w-4/12">
                                <img class="rounded-l-none md:rounded-l-2xl rounded-t-2xl w-full h-auto object-cover"
                                    src="{{ $popular->url_thumbnail ?? asset('images/ehub-cover.png') }}"
                                    onerror="this.src='{{ asset('images/ehub-cover.png') }}'" />
                            </div>
                            <div class="flex flex-col flex-1 py-3 px-6 w-full md:w-8/12 ">
                                <div class="flex gap-2">
                                    @foreach ($popular->hasTags->take(1) as $tag)
                                        <p class="text-gray-400 font-medium mb-3">{{ $tag->name }}</p>
                                    @endforeach
                                </div>
                                <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $popular->title }}</h5>
                                <div class="line-clamp-3">
                                    <p class="text-gray-700 font-medium mb-3">{!! $popular->content !!}</p>
                                </div>
                                <p class="text-gray-400 font-medium mt-3">
                                    {{ format_date($popular->created_at, 'D MMMM Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        {{-- Section program --}}
        <div class="flex flex-col py-6 w-full gap-x-8 mb-24">
            <h3 class="text-3xl font-bold max-md:mb-4 mb-8 text-center"
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
                                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-lg p-4 md:p-6">
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
                },
            }
        }).mount();
    </script>
@endsection
