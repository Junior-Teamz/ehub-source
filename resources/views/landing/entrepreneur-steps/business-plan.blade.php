@extends('landing.layouts.app')
@section('extra-title') Rencanakan Usahamu - Wirausaha @endsection
@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .splide__arrow--prev {
            left: -0.5rem;
        }

        .splide__arrow--next {
            right: -0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="flex flex-col w-full">
        <section class="mb-0 lg:mb-10 mt-4 lg:mt-0 lg:-mx-[76px]">
            <img class="w-full h-[100px] tablet-a51:h-[150px] tablet-nest:h-[210px] sm:h-[350px] md:h-[400px] lg:h-[540px] rounded-md lg:rounded-none object-cover"
                src="{{ asset('images/business/slider/journey-1-v2.png') }}" alt="Journey 1" />
        </section>

    <section class="py-8">
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col">
                <h2 class="text-xl lg:text-3xl text-primary font-bold mb-8">Cari Ide Usaha</h2>
                <p class="text-base lg:text-lg text-medium mb-6">
                    Kami akan membantu #SobatEHub untuk mencari ide, mengembangkan ide hingga mewujudkan  ide bisnismu! Ide dengan sasaran pasar yang tepat dapat membangun bisnis yang berkelanjutan.
                    <br/><br/>
                    Langkah awal untuk mencari atau mengembangkan ide adalah mencari kebutuhan pasar, masalah yang dihadapi konsumen bisa observasi langsung ke lapangan dan Survey. Dengan mencari ide bisnis bisa dengan cara brainstorming dengan mentor atau sesama teman. Beberapa sumber ide bisnis, coba cek platform : wirabisnis.com, bisnisukm.com, waralabakan.com, daya.id dll.
                </p>
            </div>
            <div class="splide w-full max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px]  sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 mx-auto" id="business-idea">
                <div class="lg:px-16 mt-8 lg:mt-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($business_ideas as $key => $business_idea)
                            <li class="splide__slide relative">
                                <a href="{{ $business_idea->website }}" target="_blank" class="flex flex-col my-10">
                                    <div class="w-full flex justify-center items-center mb-4">
                                        <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center rounded-full" src="{{ asset($business_idea->url_logo) }}" />
                                    </div>
                                    <p class="font-semibold text-xl text-center">{{ $business_idea->logo_name }}</p>
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
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col">
                <h2 class="text-xl lg:text-3xl text-primary font-bold mb-8">Saatnya Riset Pasar</h2>
                <p class="text-base lg:text-lg text-medium mb-6">
                    #Sobat EHub memiliki banyak cara untuk riset pasar, salah satunya dengan langsung terjun ke calon konsumen (validasi langsung) untuk menanyakan pendapat tentang produk kita atau menggunakan Google Trends untuk melihat gambaran lebih luas mengenai produk yang sedang trend & digunakan oleh konsumen. Cek juga apakah produk tersebut memiliki kestabilan pertumbuhan dan memiliki potensi untuk berkembang atau tidak.
                </p>
            </div>
            <div class="splide max-sm:mx-auto w-full max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px]  sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12" id="market-research">
                <div class="lg:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($market_researchs as $key => $market_research)
                            <li class="splide__slide relative">
                                <a href="{{ $market_research->website  }}" target="_blank" class="flex flex-col my-10">
                                    <div class="w-full flex justify-center items-center mb-4">
                                        <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center rounded-full" src="{{ asset($market_research->url_logo) }}" />
                                    </div>
                                    <p class="font-semibold text-xl text-center">{{ $market_research->logo_name }}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <p class="text-base lg:text-lg text-medium">
                Sobat EHub juga bisa membuat survey sederhana menggunakan Google Form  atau Survey Monkey  untuk memvalidasi ide kepada calon pelanggan potensial. Berikan insentif untuk menarik peserta seperti voucher belanja atau merchandise. Survey langsung juga bisa dilakukan dengan cara wawancara langsung kepada calon pelanggan.
            </p>
        </div>
    </section>

        <section class="py-8">
            <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
                <div class="flex flex-col">
                    <h2 class="text-xl lg:text-3xl text-primary font-bold mb-8">Buat Proposal Rencana Usahamu</h2>
                    <p class="text-base lg:text-lg text-medium mb-6">
                        Dalam bisnis #SobatEHub harus merencanakan segala hal dengan matang Sob! Mulai dari bagaimana kita
                        akan mendapatkan keuntungan? Bagaimana kita mencari cara untuk menjual produk kita dan
                        #SobatEntrepreneur akan mengelola sumber daya manusia (SDM) atau tim supaya kompak? Bagaimana
                        kalkulasi keuangannya?
                        <br /><br />
                        EHub akan membantu #SobatEHub untuk merumuskan rencana bisnis dan memandu langkah-langkah penting
                        dalam membangun bisnis. Misalnya cara analisa pasar, strategi pemasaran, model bisnis hingga
                        proyeksi keuangan.
                    </p>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <h2 class="text-xl lg:text-3xl text-primary font-bold mb-3">Download Template</h2>
                <div class="flex flex-col gap-4 justify-center">
                    <p class="text-base lg:text-lg text-medium text-center my-4">
                        Mulai rencanakan usahamu dengan unduh template yang telah kami siapkan !
                    </p>
                    <div class="flex justify-center">
                        <a href="{{ route('templates.index') }}" class="btn btn-primary w-60">Free Template</a>
                    </div>
                </div>
            </div>
        </section>

    <section class="py-8">
        <div class="flex flex-col-reverse lg:flex-row justify-between gap-10">
            <div class="flex flex-col">
                <h2 class="text-xl lg:text-3xl text-primary font-bold mb-8">Inkubasi Ide dan Rencana Usahamu</h2>
                <p class="text-base lg:text-lg text-medium mb-6">
                    Ingin ide dan usahamu didampingi? masuklah ke dalam ekosistem inkubator. Inkubator bisnis merupakan suatu program yang ditawarkan oleh berbagai lembaga guna mendukung usaha calon wirausaha dan wirausaha pemula. Dukungan pada program tersebut biasanya berupa bimbingan, pelatihan, permodalan dan penyediaan ruang untuk mengembangkan usaha. Berikut beberapa inkubator Innovative Academy, Solo Techno Incubator, Inkubator Universitas Hasanuddin, Bandung Techno Park, dan Inkubator Bisnis Stikom Bali.
                    <br/><br/>
                    Dukungan pada program tersebut biasanya berupa bimbingan dan penyediaan ruang untuk mengembangkan ide.
                </p>
            </div>
            <div class="splide w-full max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px]  sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:w-4/12 mx-auto" id="business-prototype">
                <div class="lg:px-16">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($business_incubators as $key => $business_incubator)
                            <li class="splide__slide relative">
                                <a href="{{ $business_incubator->website  }}" target="_blank" class="flex flex-col my-10">
                                    <div class="w-full flex justify-center items-center mb-4">
                                        <img class="h-28 w-28 lg:w-auto object-contain flex items-center justify-center" src="{{ asset($business_incubator->url_logo) }}" />
                                    </div>
                                    <p class="font-semibold text-xl text-center">{{ $business_incubator->logo_name }}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section
            class="max-sm:mx-auto max-[360px]:max-w-[240px] min-[360px]:max-w-[300px] min[480px]:max-w-[420px]  sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-[1280px] 2xl:max-w-[1536px] lg:mb-20">
            <h2 class="text-xl lg:text-2xl text-primary font-bold mb-4 lg:mb-8">Jika masih bingung, Sobat EHub bisa
                konsultasikan dengan mentor kami disini</h2>
            <div class="splide" id="mentor-research">
                <div class="mt-6 lg:mt-10">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($mentors as $mentor_key => $mentor)
                                <li class="splide__slide">
                                    <div
                                        class="flex flex-row gap-x-4 lg:gap-x-6 p-4 lg:p-6 rounded-2xl shadow-xl my-8 lg:my-10 w-full max-h-[356px]">
                                        <div class="flex w-6/12">
                                            <img class="w-full h-[280px] object-cover rounded mentor-photo-{{ $mentor_key }}"
                                                src="{{ $mentor->avatar_url ?? asset('images/avatar-boy.png') }}"
                                                onerror="this.src='{{ $mentor->gender == 'male' ? asset('images/avatar-boy.png') : asset('images/avatar-girl.png') }}'" />
                                        </div>
                                        <div class="flex flex-col w-6/12 max-h-[356px] gap-y-3 lg:gap-y-4">
                                            <div class="flex flex-row gap-2">
                                                <img class="w-8 h-8 object-contain" src="{{ $mentor->hasCollaborator->logo_url }}"
                                                    alt="{{ $mentor->hasCollaborator->name }}"
                                                    onerror="this.src='{{ asset('images/news/placeholder.png') }}'" />
                                                <p class="text-xs lg:text-sm">{{ $mentor->hasCollaborator->name }}</p>
                                            </div>
                                            <div class="flex flex-col">
                                                <h4
                                                    class="font-semibold text-base lg:text-lg mentor-fullname-{{ $mentor_key }}">
                                                    {{ $mentor->fullname }}</h4>
                                                <div
                                                    class="flex gap-1 py-2 flex-wrap text-white text-lg mentor-expertise-{{ $mentor_key }}">
                                                    @foreach ($mentor->hasExperts->take(2) as $expert)
                                                        <span
                                                            class="bg-secondary text-xs lg:text-sm py-1 px-2 rounded-lg whitespace-nowrap">{{ $expert->name }}</span>
                                                    @endforeach
                                                </div>
                                                <p
                                                    class="text-[#6B7280] text-xs lg:text-sm line-clamp-2 mentor-expertise-{{ $mentor_key }}">
                                                    {{ $mentor->expertise }}</p>
                                            </div>
                                            <div class="flex flex-col w-full mt-auto">
                                                @auth
                                                    @if (is_profile_updated())
                                                        <button type="button"
                                                            onclick="openModal({{ $mentor_key }}, {{ $mentor->id }})"
                                                            class="btn text-sm py-2 lg:btn-lg lg:text-base btn-primary btn-block open-modal self-end">Konsultasi</button>
                                                    @else
                                                        <a href="{{ route('profile.edit', ['next_name' => 'mentors']) }}"
                                                            class="btn text-sm py-2 lg:btn-lg lg:text-base btn-primary btn-block self-end">Konsultasi</a>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <a href="{{ route('login') }}"
                                                        class="btn text-sm py-2 lg:btn-lg lg:text-base btn-primary btn-block self-end">Konsultasi</a>
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

            <div class="flex justify-center items-center mt-6 lg:mt-10">
                <a href="{{ route('mentors.index') }}"
                    class="w-80 lg:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-outline-secondary">
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
        function mentorProperties() {
            return {
                autoplay: true,
                pagination: false,
                type: 'loop',
                perMove: 1,
                gap: '1.5rem',
                perPage: 3,
                breakpoints: {
                    1540: {
                        perPage: 2
                    },
                    1024: {
                        perPage: 1
                    },
                }
            }
        }

        function businessProperties() {
            return {
                autoplay: true,
                arrows: true,
                pagination: false,
                type: 'loop',
                perMove: 1,
                perPage: 1,
                breakpoints: {
                    576: {
                        type: 'slide',
                    }
                }
            }
        }

        new Splide("#mentor-research", mentorProperties()).mount();
        new Splide("#business-idea", businessProperties()).mount();
        new Splide("#market-research", businessProperties()).mount();
        new Splide("#business-prototype", businessProperties()).mount();

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
