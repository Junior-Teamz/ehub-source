@extends('landing.layouts.app')
@section('extra-title') Buka Usahamu - Wirausaha @endsection
@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
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
    <hr />

<div class="flex flex-col w-full">
    <section class="mb-0 md:mb-10 mt-4 md:mt-0 md:-mx-[76px]">
        <img class="w-full h-[100px] tablet-a51:h-[150px] tablet-nest:h-[210px] sm:h-[350px] md:h-[400px] lg:h-[540px] rounded-md md:rounded-none object-cover" src="{{ asset('images/business/slider/journey-2-new.png') }}" alt="Journey 2" />
    </section>

    <section class="py-8">
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col">
                <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Menentukan Badan Hukum dan Izin Usaha</h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Legalitas usaha adalah aspek yang sangat penting dalam menjalankan bisnis, karena melibatkan
                    kepatuhan terhadap hukum dan aturani yang berlaku. Untuk memastikan legalitas usaha, #SobatEHub
                    dapat menjalankan bisnis secara sah dan terlindungi secara hukum.
                </p>
                <p class="text-base md:text-lg text-medium mb-6">
                    Hal ini memberikan kepercayaan kepada pelanggan, melindungi hak-hak #SobatEHub sebagai pemilik
                    usaha, dan menghindari masalah hukum yang dapat merugikan bisnis. Dengan memiliki legalitas yang
                    sesuai, #SobatEHub dapat menjalankan operasi bisnis dengan yakin, menjaga reputasi baik, dan
                    menciptakan dasar yang stabil untuk pertumbuhan dan keberlanjutan usaha.
                </p>
                <p class="text-base md:text-lg text-medium mb-6">
                    Untuk membuat bentuk usaha badan hukum yang sesuai apakah CV, PT, Perusahaan Perseorangan dll, sobat
                    bisa mengunjungi platform Kontrak Hukum. Serta daftarkan juga usahamu baik itu HAKI, NIB, HALAL,
                    PIRT dll melalui OSS, MUI, Kemenkumkam dll.
                </p>
                <p class="text-base md:text-lg text-medium mb-6">
                    Jangan lupa untuk membuat rekening terpisah untuk usahamu ya, agar bisa terlihat cash flow dan
                    laporan laba/rugi.
                </p>
            </div>
            <div class="splide w-full max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[744px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 max-sm:mx-auto" id="legalitySection">
                <div class="mb-10 md:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($legality as $key => $legal)
                                <li class="splide__slide relative">
                                    <a href="{{ $legal->website  }}" target="_blank" class="flex flex-col my-10">
                                        <div class="flex justify-center items-center max-xl:mt-0 mt-32 mb-4">
                                            <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                src="{{ asset($legal->url_logo) }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center">{{ $legal->logo_name }}</p>
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
            <div class="splide w-full max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[744px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 mx-auto sm:px-6 md:px-8 lg:px-10"
                id="productionSection">
                <div class="mb-10 md:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($production as $key => $product)
                                <li class="splide__slide relative">
                                    <a href="{{ $product->website }}" target="_blank" class="flex flex-col my-10">
                                        <div class="flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                                            <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                src="{{ asset($product->url_logo) }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center">{{ $product->logo_name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-8">Bagaimana Cara Menentukan Produksi Usaha?
                </h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Proses produksi dalam tahapan wirausaha itu penting banget Sob! Proses produksi dapat membuat ide
                    bisnis terwujud. Mulai dari bahan baku, perakitan sampai jadi produk jadi. Semua itu melalui proses
                    produksi. Kalo proses produksinya bagus dan efisien, #SobatEHub bisa menghasilkan barang
                    berkualitas, dengan harga yang kompetitif. Selain itu, proses produksi yang tepat juga mempengaruhi
                    kecepatan pengiriman dan kepuasan pelanggan.
                </p>
                <p class="text-base md:text-lg text-medium mb-6">
                    Jadi proses produksi adalah fondasi bisnis kita Sob! #SobatEHub bisa tentukan lokasi usaha
                    (online/offline), cara produksi, menentukan jumlah produksi, kontrol kualitas, design, packaging
                    usahamu apakah memproduksi langsung, makloon, franchise dll. #SobatEHub bisa bekerja sama dengan
                    rumah produksi bersama/factory sharing seperti dengan Skyeats, Praktis atau bekerja sama dengan
                    supplier seperti Warjali, Beliayam, dan platform makloon manufaktur Manuva.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col justify-center">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-8">Distribusi dan Pengiriman (Warehousing,
                    Logistic)</h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Distribusi mempunyai peranan penting dalam suatu usaha. Untuk itu, diperlukan pengelolaan yang baik
                    guna mengoptimalkan proses pengiriman barang. Salah satu faktor pendukung penting adalah layanan
                    pengiriman yang handal, baik pengiriman kepada konsumen maupun pengiriman untuk kepentingan
                    operasional usaha. Berikut beberapa contoh platform distribusi dan pengiriman yakni Shipper, Sakago,
                    Praktis.
                </p>
            </div>
            <div class="splide w-full max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[744px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 mx-auto"
                id="distributionSection">
                <div class="mb-10 md:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($distribution as $key => $distribute)
                                <li class="splide__slide relative">
                                    <a href="{{ $distribute->website }}" target="_blank" class="flex flex-col my-10">
                                        <div class="flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                                            <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                src="{{ asset($distribute->url_logo) }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center">{{ $distribute->logo_name }}</p>
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
            <div class="splide w-full max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[744px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 mx-auto"
                id="marketingSection">
                <div class="mb-10 md:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($marketing as $key => $market)
                                <li class="splide__slide relative">
                                    <a href="{{ $market->website }}" target="_blank" class="flex flex-col my-10">
                                        <div class="flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                                            <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                src="{{ asset($market->url_logo) }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center">{{ $market->logo_name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Pemasaran</h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Mencakup strategi apa yang harus kita susun untuk menjual barang? Cara apa yang dapat kita pakai? Di
                    era serba canggih saat ini, jika sasaran pasar kita adalah masyarakat yang melek teknologi kita
                    dapat menyusun rencana marketing dengan memanfaatkan media sosial, website, hingga Search Engine
                    Optimation (SEO).
                    <br /><br />
                    Jika ingin memasarkan produk/layanan penting ke berbagai kalangan untuk dikenal terlebih dahulu
                    termasuk dengan memakai jasa influencer/ pemengaruh sekarang sudah ada platform yang dapat
                    menyambungkan ke influencer sesuai dengan target masing-masing usaha. Setelah merek #SobatEHub
                    dikenal maka nanti akan terjadi penjualan dan usahamu mendapat pendapatan. Berikut beberapa platform
                    yang bisa membantu seperti Ayowebs, Uwala, Ruanghalal, Soodu, Kreatiful, dan Dynamicbuzz.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col justify-center">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-8">Keuangan</h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Keuangan bisnismu berantakan? banyak yang tidak tercatat? kelihatan untung di laporan keuangan tapi
                    ternyata yang cash nya tidak ada? Maka dari itu analisis dan pengelolaan keuangan sangat penting
                    dalam bisnis. #SobatEHub bisa tahu apakah keuangan perusahaan kita itu sehat atau sakit? karena ini
                    berhubungan dengan langkah selanjutnya yaitu ketika #SobatEHub ingin ekspansi bisnis, keuangan harus
                    sehat dan tercatat. Aplikasi Credibook dapat membatu #SobatEHub dalam mengurus keuangan.
                </p>
            </div>
            <div class="splide w-full max-w-[320px] sm:max-w-[640px] md:max-w-full lg:w-4/12 mx-auto"
                id="financeSection">
                <div class="mb-10 md:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($finances as $key => $finance)
                                <li class="splide__slide relative">
                                    <a href="{{ $finance->website }}" target="_blank" class="flex flex-col my-10">
                                        <div class="flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                                            <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}"
                                                src="{{ asset($finance->url_logo) }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center">{{ $finance->logo_name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[744px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] sm:p-6 md:p-8 lg:p-10 mb-16 md:mb-20">
        <h2 class="text-xl md:text-3xl text-primary font-bold mb-4 md:mb-8">Jika masih bingung, Sobat EHub bisa
            konsultasikan dengan mentor kami disini</h2>
        <div class="splide w-full mx-auto" id="mentor-section">
            <div class="mt-6 md:mt-10">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($mentors as $mentor_key => $mentor)
                            <li class="splide__slide">
                                <div class="flex flex-row gap-x-4 md:gap-x-6 p-4 md:p-6 rounded-2xl shadow-xl my-8 md:my-10 w-full max-h-[356px]">
                                    <div class="flex w-6/12">
                                        <img class="w-full h-[280px] md:h-[300px] object-cover rounded mentor-photo-{{ $mentor_key }}" src="{{ $mentor->avatar_url ?? asset('images/avatar-boy.png') }}" onerror="this.src='{{ $mentor->gender == 'male' ? asset('images/avatar-boy.png') : asset('images/avatar-girl.png') }}'" />
                                    </div>
                                    <div class="flex flex-col w-6/12 max-h-[356px] gap-y-3 md:gap-y-4">
                                        <div class="flex flex-row gap-2">
                                            <img class="w-8 h-8 object-contain" src="{{ $mentor->hasCollaborator->logo_url }}" alt="{{ $mentor->hasCollaborator->name }}" onerror="this.src='{{ asset('images/news/placeholder.png') }}'"/>
                                            <p class="text-xs md:text-sm">{{ $mentor->hasCollaborator->name }}</p>
                                        </div>
                                        <div class="flex flex-col">
                                            <h4 class="font-semibold text-base md:text-lg mentor-fullname-{{ $mentor_key }}">{{ $mentor->fullname }}</h4>
                                            <div class="flex gap-1 py-2 flex-wrap text-white text-lg mentor-expertise-{{ $mentor_key }}">
                                                @foreach ($mentor->hasExperts->take(2) as $expert)
                                                    <span class="bg-secondary text-xs md:text-sm py-1 px-2 rounded-lg whitespace-nowrap">{{ $expert->name }}</span>
                                                @endforeach
                                            </div>
                                            <p class="text-[#6B7280] text-xs md:text-sm line-clamp-2 mentor-expertise-{{ $mentor_key }}">{{ $mentor->expertise }}</p>
                                        </div>
                                        <div class="flex flex-col w-full mt-auto">
                                            @auth
                                                @if(is_profile_updated())
                                                    <button type="button" onclick="openModal({{ $mentor_key }}, {{ $mentor->id }})" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block open-modal self-end">Konsultasi</button>
                                                @else
                                                    <a href="{{ route('profile.edit', ['next_name' => 'mentors']) }}" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                                @endif
                                            @endauth
                                            @guest
                                                <a href="{{ route('login') }}" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex justify-center items-center mt-6 md:mt-10">
            <a href="{{ route('mentors.index') }}"
                class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-outline-secondary">
                <span class="font-semibold">Cek Semua Mentor</span>
                <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
            </a>
        </div>
    </section>
</div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
        new Splide("#legalitySection", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            // type: 'loop',
            gap: '2rem',
            perPage: 1
        }).mount();

        new Splide("#mentor-section", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            type: 'loop',
            gap: '2rem',
            perPage: 3,
            breakpoints: {
                1540:{
                    perPage: 2
                },
                1024: {
                    perPage: 1
                },
            }
        }).mount();

        new Splide("#productionSection", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            // type: 'loop',
            gap: '2rem',
            perPage: 1
        }).mount();

        new Splide("#distributionSection", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            // type: 'loop',
            gap: '2rem',
            perPage: 1
        }).mount();


        new Splide("#marketingSection", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            // type: 'loop',
            gap: '2rem',
            perPage: 1
        }).mount();

        new Splide("#financeSection", {
            autoplay: true,
            pagination: false,
            perMove: 1,
            arrows: false,
            // type: 'loop',
            gap: '2rem',
            perPage: 1
        }).mount();


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
    </script>
@endsection
