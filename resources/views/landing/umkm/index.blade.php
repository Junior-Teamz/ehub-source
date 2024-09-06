@extends('landing.layouts.app')
@section('extra-title') Kolaborator @endsection
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
        <h1 class="text-white">Kolaborator</h1>
    </div>
@endsection

@section('content')
    <div class="flex flex-col w-full">
        <section class="flex flex-col w-full">
            <div class="flex flex-row items-center justify-center pb-2 pt-8 md:py-16 w-full"
                action="{{ route('umkm.index') }}" method="GET">
                <form class="flex flex-row items-center w-full md:w-9/12">
                    <div class="relative flex flex-1 mr-3 md:mr-6">
                        <svg class="absolute top-3 md:top-2.5 w-7 h-7 md:w-8 md:h-8 ml-2 md:ml-4" width="33"
                            height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                            class="rounded-xl border border-gray-400 pl-10 md:pl-16 py-3 placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600"
                            name="keyword" placeholder="Cari kolaborator" value="{{ request()->input('keyword') }}" />
                    </div>
                    <button class="px-7 py-3 border border-primary bg-primary rounded-xl text-white"><span
                            class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Kolaborator</span></button>
                </form>
            </div>

            {{-- Section filter & Collaborator --}}
            <div class="flex flex-col lg:flex-row py-6 w-full gap-x-8">
                {{-- Filter --}}
                <div class="w-4/12 hidden lg:flex flex-col">
                    <p class="text-2xl font-bold mb-6">Filter</p>
                    <form method="GET" action="{{ route('umkm.index') }}" id="formFilter" class="flex flex-col">

                        <div class="flex flex-col py-6 border-b border-gray-200">
                            <p class="text-lg font-semibold text-gray-400 font-sans mb-6">Kategori</p>
                            <div class="flex flex-col gap-y-5">
                                @foreach ($tags as $tag)
                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" name="filterCategory[]"
                                            class="p-2.5 text-primary border border-gray-400 rounded-md focus:ring-primary cursor-pointer"
                                            value="{{ $tag->name }}"
                                            onchange="document.getElementById('formFilter').submit();"
                                            {{ $filterCategory ? (in_array($tag->name, $filterCategory) ? 'checked' : '') : '' }}>
                                        <span class="font-medium ml-4 text-neutral-800">{{ $tag->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="w-full flex flex-col lg:hidden">
                    <div
                        class="flex flex-row items-center max-w-[calc(100vw-3rem)] overflow-x-hidden overflow-y-visible border-b-2 border-neutral-300 gap-x-4 mb-4">
                        <div class="w-fit {{ isset($filterCategory) ? 'hidden' : 'flex' }} flex-row items-center text-neutral-800 pb-3 pr-2"
                            id="elLabelFilter">
                            <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 4C3 3.44772 3.44772 3 4 3H20C20.5523 3 21 3.44772 21 4V6.58579C21 6.851 20.8946 7.10536 20.7071 7.29289L14.2929 13.7071C14.1054 13.8946 14 14.149 14 14.4142V17L10 21V14.4142C10 14.149 9.89464 13.8946 9.70711 13.7071L3.29289 7.29289C3.10536 7.10536 3 6.851 3 6.58579V4Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="font-bold ml-2 text-lg"> Filter </span>
                        </div>
                        <a href="{{ route('umkm.index') }}"
                            class="w-fit {{ isset($filterCategory) ? 'flex' : 'hidden' }} flex-row items-center text-neutral-800 pb-3 pr-2"
                            id="elResetFilter">
                            <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 4V9H4.58152M19.9381 11C19.446 7.05369 16.0796 4 12 4C8.64262 4 5.76829 6.06817 4.58152 9M4.58152 9H9M20 20V15H19.4185M19.4185 15C18.2317 17.9318 15.3574 20 12 20C7.92038 20 4.55399 16.9463 4.06189 13M19.4185 15H15"
                                    stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="font-bold ml-2 text-base"> Reset Filter </span>
                        </a>
                        <div class="flex flex-row items-center overflow-x-auto overflow-y-visible no-scrollbar ">
                            <a type="button" href="#" id="elBtnFilter"
                                class="cursor-pointer tab text-neutral-800 hover:border-b-2 pb-3 hover:border-primary {{ isset($filterCategory) ? 'border-b-4 border-primary' : '' }}">Kategori</a>
                        </div>
                    </div>
                    <div class="{{ isset($filterCategory) ? 'flex' : 'hidden' }} flex-row items-center max-w-[calc(100vw-3rem)] overflow-hidden"
                        id="elContentCategory">
                        <form method="GET" action="{{ route('umkm.index') }}"
                            class="flex flex-row items-center overflow-x-auto pb-3 gap-x-2" id="formFilterMobile">
                            @foreach ($tags as $tag)
                                <div class="flex flex-row items-center">
                                    <input type="checkbox" name="filterCategory[]" id="category-{{ $tag->id }}"
                                        class="hidden" value="{{ $tag->name }}"
                                        onchange="document.getElementById('formFilterMobile').submit();">
                                    <label for="category-{{ $tag->id }}"
                                        class="p-2 rounded-xl cursor-pointer  {{ isset($filterCategory) ? (in_array($tag->name, $filterCategory) ? 'bg-primary text-white' : 'bg-white text-neutral-800 border border-neutral-400') : 'bg-white text-neutral-800 border border-neutral-400' }}">
                                        <span class="font-medium whitespace-nowrap text-sm">{{ $tag->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
                {{-- Kolaborator --}}
                <div class="flex flex-col w-full lg:w-8/12">
                    <div class="pt-8 lg:pt-0 mb-11">
                        <h3 class="text-3xl text-primary text-center lg:text-left font-bold mb-3">Kolaborator</h3>
                        <span class="text-lg">Temukan berbagai peluang kolaborasi bersama kolaborator dari seluruh
                            Indonesia</span>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 pb-[72px]">
                        @foreach ($collaborators as $collaborator_key => $collaborator)
                            <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
                                <img class="w-full max-h-[200px] object-cover" src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}"
                                    alt="{{ $collaborator->name }}" />
                                <div class="flex flex-col px-5 py-6 flex-1">
                                    <div class="flex flex-row gap-4 items-center mb-6">
                                        <img class="w-12 h-12 object-cover" src="{{ $collaborator->logo_url }}"
                                            alt="{{ $collaborator->name }}" />
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="font-semibold text-primary text-lg">{{ $collaborator->name }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col h-full justify-between">
                                            <div class="flex flex-col gap-2 mb-6">
                                                <div
                                                    class="flex flex-wrap gap-2 text-white text-sm collaborator->hasTags-{{ $collaborator_key }}">
                                                    @foreach ($collaborator->hasTags as $tags_key => $tags)
                                                        @if ($tags_key < 2)
                                                            <span
                                                                class="badge bg-secondary whitespace-nowrap px-2 rounded-lg">{{ $tags->name }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="line-clamp-3">
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
                        @endforeach
                    </div>
                    <div class="flex justify-center mb-2 lg:mb-10">
                        {{ $collaborators->links('vendor.pagination.custom-2') }}</div>
                </div>
            </div>
            <div class="py-5 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
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
                                Kolaborator
                                <br>
                                Entrepreneur Hub
                            </h2>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center md:pr-8 xl:pr-0 lg:max-w-lg">

                        <div class="max-w-xl mb-6 mr-5">
                            <h2 class="text-4xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Kolaborator</h2>
                            <p class="text-base md:text-lg text-medium mb-6">
                                Yuk! bergabung bersama kami menjadi bagian penggerak ekosistem kewirausahaan Indonesia
                                sebagai kolaborator bersama EntrepreneurHub! Mari kita bersatu tangan untuk menciptakan
                                ekosistem kewirausahaan yang terkoneksi. Tunggu apa lagi? Bergabunglah bersama kami untuk
                                berkontribusi secara nyata dan wujudkan impian kita bersama!
                            </p>
                        </div>

                        <div class="flex justify-start items-center h-[calc(100%-3rem)] ">
                            <a href="http://bit.ly/FormKolaboratorEhub"
                                class="w-65 mr-4 flex flex-row justify-center items-center self-center gap-2 btn btn-lg bg-secondary">
                                <span class="font-semibold text-white">Bergabung Sebagai Kolaborator</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="-mx-[40px] md:-mx-[76px] py-[72px] mt-5 hidden lg:block">
            <div class="px-[40px] md:px-[76px]">
                <h3 class="font-bold text-3xl text-[#0F1010] mb-8">Kabar Terkini</h3>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
                    @foreach ($news->slice(0, 4) as $news_item)
                        <a href="{{ route('news.detail', $news_item->slug) }}">
                            <div class="md:flex rounded-xl shadow-xl">
                                <img class="w-full md:w-48 h-40 md:h-auto rounded-l-xl mx-auto object-cover"
                                    src="{{ $news_item->url_thumbnail ?? asset('images/ehub-cover.png') }}" alt="{{ $news_item->title }}" onerror="this.src='{{ asset('images/ehub-cover.png') }}'"/>
                                <div class="px-6 py-3 text-left space-y-4 w-full">
                                    <div class="flex flex-col gap-3 h-full justify-between">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($news_item->hasTags->take(2) as $tag)
                                                <span class="text-[#9CA3AF]">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                        <h5 class="text-[#111827] text-xl font-semibold line-clamp-2">{{ $news_item->title }}</h5>
                                        <div class="line-clamp-3">
                                            <p class="text-gray-700 font-medium mb-3">{!! $news_item->content !!}</p>
                                        </div>
                                        <span class="text-[#9CA3AF]">{{ format_date($news_item->created_at, 'D MMMM Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-center items-center">
                    <a href="{{ route('news.index') }}"
                        class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-primary">
                        <span class="font-semibold">Cek kabar lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-white font-semibold"></ion-icon>
                    </a>
                </div>
            </div>
        </section>
        <section class="max-w-[calc(100vw-2.5rem)] sm:max-screen-sm splide block lg:hidden">
            <div class="splide" id="news-section">
                <div class="flex flex-col items-center gap-6">
                    <h3 class="text-primary text-3xl text-center font-semibold">Kabar Terkini</h3>
                </div>
                <div class="mt-10">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($news->take(3) as $key => $news_item)
                                <li class="splide__slide">
                                    <a href="{{ route('news.detail', $news_item->slug) }}"
                                        class="flex flex-col rounded-2xl mx-3 my-6 overflow-hidden shadow-lg h-[calc(100%-3rem)]">
                                        <img class="w-full max-h-[200px] object-cover"
                                            src="{{ $news_item->url_thumbnail }}" alt="{{ $news_item->title }}" />
                                        <div class="flex flex-col px-5 py-6 flex-1">
                                            <div class="flex flex-col h-full justify-between">
                                                <div class="flex flex-col gap-2 mb-4">
                                                    <div
                                                        class="flex gap-2 py-1 text-white text-sm news-hasTags-{{ $key }}">
                                                        @foreach ($news_item->hasTags->take(2) as $tag)
                                                            <span
                                                                class="bg-secondary text-sm py-1 px-2 rounded-lg">{{ $tag->name }}</span>
                                                        @endforeach
                                                    </div>
                                                    <h5 class="font-bold text-xl text-[#0F1010]">{{ $news_item->title }}
                                                    </h5>
                                                    <div class="line-clamp-3">
                                                        <p class="text-gray-700 font-medium mb-3">{!! $news_item->content !!}</p>
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-[#9CA3AF]">{{ format_date($news_item->created_at, 'D MMMM Y') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-8">
                    <a href="{{ route('news.index') }}"
                        class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
                        <span class="font-semibold">Cek kabar lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-white font-semibold"></ion-icon>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        const labelFiter = document.getElementById('elLabelFilter');
        const btnFilter = document.getElementById('elBtnFilter');
        const contentCategory = document.getElementById('elContentCategory');
        const resetFilter = document.getElementById('elResetFilter');
        var isActiveFilterCategory = {{ isset($filterCategory) ? 1 : 0 }};
        btnFilter.addEventListener('click', function(e) {
            if (isActiveFilterCategory) {
                contentCategory.classList.remove('flex');
                contentCategory.classList.add('hidden');
                isActiveFilterCategory = false;
            } else {
                contentCategory.classList.remove('hidden');
                contentCategory.classList.add('flex');
                isActiveFilterCategory = true;
            }
        });
        new Splide("#news-section", {
            arrows: true,
            autoplay: true,
            interval: 4000,
            pagination: true,
            type: 'loop',
            fixedHeight: '540px',
            fixedWidth: '100%',
            interval: 3000,
            pauseOnHover: true,
            perPage: 1,
        }).mount();
    </script>
@endsection
