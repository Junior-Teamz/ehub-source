@extends('landing.layouts.app')
@section('extra-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
<style>
</style>
@endsection
@section('content')
    <div class="flex flex-col w-full">
        <section class="mb-10 md:mb-20 mt-4 md:mt-8">
            <div class="relative">
                <img class="w-full h-full object-cover rounded-2xl" src="{{ asset('images/business-foundation.jpg') }}" alt="Slider 1" />
                <div class="w-full h-full absolute left-0 top-0 px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 my-auto">
                    <div class="flex flex-col items-start justify-start md:justify-center w-7/12 sm:w-6/12 lg:w-5/12 h-full">
                        <h1 class="text-left text-lg sm:text-2xl md:text-4xl lg:text-5xl xl:text-6xl sm:leading-8 md:leading-[48px] lg:leading-[64px] xl:leading-[72px] my-auto font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960]">
                            Bagaimana cara untuk mengembangkan ide?
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="md:mb-20 mb-10">
            <div class="flex flex-col justify-center text-center px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16">
                <h2 class="text-xl md:text-2xl text-primary font-bold mb-4 sm:mb-6 md:mb-8">Kami akan membantu #SobatEntrepreneur untuk mencari ide, mengembangkan ide hingga mewujudkan  ide bisnismu! Ide yang tervalidasi dengan sasaran market yang tepat dapat membangun bisnis yang berkelanjutan</h2>
                <p class="text-base md:text-lg text-medium mb-6">
                    Langkah awal untuk mencari atau mengembangkan ide adalah mencari kebutuhan pasar, masalah yang dihadapi konsumen bisa observasi langsung ke lapangan dan Survey. Dengan mencari ide bisnis bisa dengan cara brainstorming dengan mentor atau sesama teman. Selanjutnya bisa membuat prototypenya, sederhana saja. Langkah akhir bisa uji coba ke pasar dengan mengumpulkan orang atau wawancara satu-satu. Paling utama adalah konsultasikan idemu ke mentor-mentor hebat.
                </p>
            </div>
        </section>

        <section class="md:mb-20 mb-10">
            <div class="flex flex-col px-4">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-12 md:mb-16">Jelajahi program kewirausahaan untuk membantu mengembangkan bisnismu</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mb-12 md:mb-16">
                    @foreach($workshops as $key => $workshop)
                        <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
                            <img class="w-auto h-[411px] object-cover" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" />
                            <div class="px-6 pt-6 pb-8 flex-1">
                                <div class="flex flex-col h-full justify-between">
                                    <div class="flex flex-col items-start">
                                        <div class="flex flex-row items-center gap-2">
                                            <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : '' }}" />
                                            <span>{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : '' }}</span>
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
                                        <a href="{{ route('workshops.detail', $workshop->slug) }}" class="btn btn-lg btn-primary btn-block">Lihat Program</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('mentors.index') }}" class="flex flex-row justify-center items-center gap-2 btn btn-lg btn-outline-secondary">
                        <span class="font-semibold">Jelajahi Program Lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
                      </a>
                </div>
            </div>
        </section>

        <section class="md:mb-20 mb-10">
            <div class="flex flex-col">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-10">Konsultasikan langkahmu dengan mentor Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mb-10">
                    @foreach ($mentors->slice(0, 3) as $mentor_key => $mentor)
                        <div class="flex flex-col rounded-xl shadow-xl">
                            <img class="w-auto h-[400px] object-cover rounded-t-xl mentor-photo-{{ $mentor_key }}" src="{{ $mentor->avatar_url }}" />
                            <div class="flex flex-col px-6 pt-6 pb-8 gap-2">
                                <div class="flex flex-row items-center gap-2">
                                    <img class="w-auto h-8 object-contain" src="{{ $mentor->hasCollaborator->logo_url }}" alt="{{ $mentor->hasCollaborator->name }}" />
                                    <span>{{ $mentor->hasCollaborator->name }}</span>
                                </div>
                                <h4 class="font-semibold text-xl mentor-fullname-{{ $mentor_key }}">{{ $mentor->fullname }}</h4>
                                <span class="text-[#6B7280] text-lg mentor-expertise-{{ $mentor_key }}">{{ $mentor->expertise }}</span>
                                @auth
                                    @if (is_profile_updated())
                                        <button type="button" onclick="openModal({{ $mentor_key }}, {{ $mentor->id }})" class="btn btn-lg btn-primary btn-block mt-5 open-modal">Konsultasi</button>
                                    @else
                                        <a href="{{ route('profile.edit', ['next_name' => 'mentors']) }}" class="btn btn-lg btn-primary btn-block mt-5">Konsultasi</a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block mt-5">Konsultasi</a>
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('mentors.index') }}" class="flex flex-row justify-center items-center gap-2 btn btn-lg btn-outline-secondary">
                        <span class="font-semibold">Jelajahi Mentor Lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
                      </a>
                </div>
            </div>
        </section>
        <section class="md:mb-20 mb-10">
            <div class="flex flex-col">
                <h2 class="text-xl md:text-4xl text-primary font-bold mb-10">Jelajahi komunitas bisnis yang akan meningkatkan skill wirausaha</h2>
                <div class="splide max-w-[400px] sm:max-w-[640px] md:max-w-[768px] lg:max-w-[1288px] mx-auto" id="communitySection">
                    <div class="mb-10">
                        <div class="splide__track">
                            <ul class="splide__list">
                              @foreach($communities as $key => $community)
                                <li class="splide__slide relative">
                                    <a href="https://daya.id" target="_blank" class="flex flex-col w-max my-10">
                                        <div class="w-full flex items-center md:items-start justify-center md:justify-start mb-4">
                                            <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center community-photo-{{ $key }}" src="{{ asset('images/logos/daya-logo.jpg') }}" />
                                        </div>
                                        <p class="font-semibold text-xl text-center md:text-left">Daya.id</p>
                                    </a>
                                </li>
                              @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Temporary comment -->
                <!-- <div class="flex justify-center">
                    <a href="{{ route('umkm.index') }}" class="flex flex-row justify-center items-center gap-2 btn btn-lg btn-outline-secondary">
                        <span class="font-semibold">Jelajahi Komunitas Lainnya</span>
                        <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
                      </a>
                </div> -->
            </div>

        </section>
    </div>
@endsection
@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
    new Splide("#communitySection", {
      autoplay: false,
      arrows: false,
      pagination: false,
      perMove: 1,
      gap: '2rem',
      perPage: 1,
      breakpoints: {
        768: {
          perPage: 2
        },
        576: {
          perPage: 1
        }
      }
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
    const closeModal = function () {
        modalConsult.classList.remove('flex');
        content.classList.remove('modal-active');
        modalConsult.classList.add('hidden');
    };
    closeModalBtnConsult.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
  </script>
@endsection
