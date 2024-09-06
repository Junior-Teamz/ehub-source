@extends('landing.layouts.app')
@section('extra-title') Kembangkan Usahamu - Wirausaha @endsection

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
@endsection

@section('content')
    <hr />

    <div class="flex flex-col w-full">
        <section class="mb-0 md:mb-10 mt-4 md:mt-0 md:-mx-[76px]">
            <img class="w-full h-[100px] tablet-a51:h-[150px] tablet-nest:h-[210px] sm:h-[350px] md:h-[400px] lg:h-[540px] rounded-md md:rounded-none object-cover" src="{{ asset('images/business/slider/journey-3-new.png') }}" alt="Journey 3" />
        </section>

        <section class="py-8">
            <div class="flex flex-col lg:flex-row justify-between gap-10 lg:items-center">
                <div class="splide w-full max-w-[320px] sm:max-w-[640px] md:max-w-full lg:w-4/12 mx-auto" id="enablerSlider">
                    <div class="mb-6 md:mb-10 md:px-16">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($enablers as $key => $enabler)
                                    <li class="splide__slide relative">
                                        <a href="{{ $enabler->website }}" target="_blank" class="flex flex-col my-6 md:my-10">
                                            <div class="flex justify-center items-center max-xl:mt-0 mt-8 md:mt-16 mb-4">
                                                <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                    src="{{ asset($enabler->url_logo) }}" />
                                            </div>
                                            <p class="font-semibold text-xl text-center">{{ $enabler->logo_name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Enabler</h2>
                    <p class="text-base md:text-lg text-medium mb-6">
                        Enabler merupakan penyedia jasa yang memberikan layanan one-step untuk membantu pelaku usaha
                        termasuk UMKM dan startup dalam mengelola segala kegiatan bisnisnya. Contoh Chatbiz, PadiUMKM, LKPP,
                        Instellar, dan Jakarta Impact Hub.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-8">
            <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
                <div class="flex flex-col justify-center">
                    <h2 class="text-xl md:text-4xl text-primary font-bold mb-8">Ekspor</h2>
                    <p class="text-base md:text-lg text-medium mb-6">
                        Ekspor merupakan salah satu cara untuk menjual barang ke pasar internasional. Dengan mengekspor
                        produk yang bagus dan cocok untuk pasar luar negeri, kita dapat membuka peluang bisnis baru,
                        menjangkau pasar yang lebih luas, dan meningkatkan pendapatan. Pelanggan baru dapat ditemukan dengan
                        mengekspor, dan kita dapat mengeksplorasi platform online atau bekerja sama dengan distributor di
                        negara lain untuk memperluas pasar.
                    </p>
                </div>
                <div class="splide w-full max-w-[320px] sm:max-w-[640px] md:max-w-full lg:w-4/12 mx-auto" id="exportSlider">
                    <div class="mb-6 md:mb-10 md:px-16">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($exports as $key => $export)
                                    <li class="splide__slide relative">
                                        <a href="{{ $export->website }}" target="_blank" class="flex flex-col my-6 md:my-10">
                                            <div class="flex justify-center items-center max-xl:mt-0 mt-8 md:mt-16 mb-4">
                                                <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                    src="{{ asset($export->url_logo) }}" />
                                            </div>
                                            <p class="font-semibold text-xl text-center">{{ $export->logo_name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-8">
            <div class="flex flex-col lg:flex-row justify-between gap-10">
                <div class="splide w-full max-w-[320px] sm:max-w-[640px] md:max-w-full lg:w-4/12 mx-auto" id="fundingSlider">
                    <div class="mb-6 md:mb-10 md:px-16">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($fundings as $key => $funding)
                                    <li class="splide__slide relative">
                                        <a href="{{ $funding->website }}" target="_blank" class="flex flex-col my-6 md:my-10">
                                            <div class="flex justify-center items-center max-xl:mt-0 mt-8 md:mt-16 mb-4">
                                                <img class="h-28 w-28 md:w-40 object-contain flex items-center justify-center community-photo-{{ $key }}" src="{{ asset($funding->url_logo) }}" />
                                            </div>
                                            <p class="font-semibold text-xl text-center">{{ $funding->logo_name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl md:text-4xl text-primary font-bold mb-8">Funding</h2>
                    <p class="text-base md:text-lg text-medium">
                        Pendanaan merupakan aspek penting untuk pengembangan bisnis kita, peluang pendanaan saat ini sangat
                        besar! #SobatEntrepreneur dapat mencoba meraih pendanaan dari berbagai sektor, mulai dari
                        pemerintah, investor, hingga perusahaan swasta. Berikut beberapa platform yang bisa untuk pendanaan
                        yakni investree, pintar ventura group, East Venture, Angin (Angel Investor), Fundex (Crowdfunding),
                        dan BTPN (Bank).
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        const sliderConfig = {
            arrows: true,
            autoplay: true,
            pagination: false,
            perMove: 1,
            type: 'loop',
            gap: '1rem',
            perPage: 1
        };

        new Splide("#exportSlider", sliderConfig).mount();
        new Splide("#enablerSlider", sliderConfig).mount();
        new Splide("#fundingSlider", sliderConfig).mount();
    </script>
@endsection
