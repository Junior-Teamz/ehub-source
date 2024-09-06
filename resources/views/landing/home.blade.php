@extends('landing.layouts.app')
@section('extra-title') Beranda @endsection

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
    .splide__arrow.splide__arrow--prev, .splide__arrow.splide__arrow--next {
        margin-top: 2rem;
    }
    #partner-section .splide__arrow.splide__arrow--prev, #partner-section .splide__arrow.splide__arrow--next {
        margin-top: 5px;
    }
    @media (max-width : 768px) {

        .splide__arrow.splide__arrow--prev, .splide__arrow.splide__arrow--next {
            /* margin-top: 1rem; */
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    .hiddenStyle {
        position: absolute;
        overflow: hidden;
        clip: rect(0 0 0 0);
        height: 1px;
        width: 1px;
        margin: -1px;
        padding: 0;
        border: 0;
    }
</style>
@endsection

@section('content')
<section class="mt-2 sm:mt-0 mb-8 md:-mx-[76px]">
    <div class="splide mx-auto items-center justify-center" id="hero-slider">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="relative flex flex-col-reverse sm:flex-row bg-neutral-100  w-auto lg:w-full h-[210px] sm:h-full md:rounded-none rounded-2xl">
                        <div class="absolute w-full h-[210px] lg:h-full bottom-0 left-0">
                            <img class="w-full h-full object-cover" src="{{ asset('images/pattern-spiral-mobile.png') }}">
                        </div>
                        <div class="flex flex-row items-center w-8/12 h-[210px] sm:h-full ml-auto self-end justify-end relative">
                            <img class="w-8/12 max-tablet-nest:hidden object-contain absolute top-12 sm:top-28 md:top-32 md:-left-4 lg:left-10 lg:top-20 xl:top-8 left-0 2xl:-left-10" src="{{ asset('images/new-hero-slider-1-person-1-name.png') }}">
                            <img class="w-9/12 max-tablet-nest:hidden object-contain ml-auto absolute sm:top-20 top-8 md:top-24 lg:top-10 xl:-top-8 -right-10 md:-right-30 lg:-right-32" src="{{ asset('images/new-hero-slider-1-person-3-name.png') }}">
                            <img class="w-6/12 max-tablet-nest:hidden object-contain absolute top-20 sm:top-40 sm:left-32 md:top-44 md:left-40 lg:top-32 lg:left-64 xl:left-80 xl:top-24 left-20 " src="{{ asset('images/new-hero-slider-1-person-2-name.png') }}">
                        </div>
                        <div class="w-auto lg:w-full h-[150px] tablet-nest-max:h-[210px]   absolute left-0 top-0 px-6 sm:px-[76px] my-auto">
                            <div class="flex flex-col items-start justify-start tablet-nest:justify-center sm:justify-center w-full sm:w-2/5 h-full max-tablet-a51:mt-0 tablet-a51:mt-4 tablet-nest:mt-0 sm:mt-16 md:mt-24 lg:mt-32">
                                <h1 class="text-left text-sm sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl mb-1 tablet-nest:mb-2 tablet-nest-max:mb-4 sm:mb-0 lg:leading-[72px] font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960]">
                                Yuk! Gabung <br />di Ekosistem EntrepreneurHub!
                                </h1>
                                <h6 class="max-tablet-nest:hidden font-medium text-xs sm:text-base text-left text-[#374151] mb-1 tablet-nest:mb-2 tablet-nest-max:mb-4">Ayo Tumbuh bersama <br class="block sm:hidden"/>EntrepreneurHub</h6>
                                <a href="{{ route('register') }}" class="btn md:btn-lg btn-secondary text-xs sm:text-base mt-2 sm:mt-4 max-tablet-nest:hidden">Bergabung di EntrepreneurHub</a>
                                <a href="{{ route('register') }}" class="btn md:btn-lg btn-secondary text-xs sm:text-base mt-2 sm:mt-4 tablet-nest:hidden">Bergabung Ehub</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide relative">
                    <div class="relative h-full">
                        <img class="w-full h-full rounded-md md:rounded-none object-cover" src="{{ asset('images/new-hero-slider-2.png') }}" alt="Slider 2" />
                    </div>
                </li>
                <li class="splide__slide relative">
                    <div class="relative h-full">
                        <img class="w-full h-full rounded-md md:rounded-none object-cover" src="{{ asset('images/new-hero-slider-3.jpg') }}" alt="Slider 3" />
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 flex flex-col xl:flex-row gap-8 md:gap-16 py-16 md:py-20">
    <img id="open-modal-btn" class="rounded-xl w-full xl:w-6/12 h-fit object-contain cursor-pointer" src="{{ asset('images/illus-female.png') }}" alt="Illus Female" />
    <div class="flex flex-col justify-center">
        <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Apa Entrepreneur Hub Itu?</h2>
        <p class="text-base md:text-lg text-medium mb-6">
            EntrepreneurHub merupakan platform ekosistem wirausaha Indonesia agar berwirausaha jadi lebih mudah. Platform ini memberikan berbagai informasi untuk berwirausaha mulai dari mencari ide usaha, mengelola dan mengembangkan usahanya sehingga untuk menjadi wirausaha akan menjadi lebih mudah.
            <br/><br/>
            EHub berkolaborasi dengan berbagai pihak seperti pelaku usaha, komunitas, universitas, inkubator, pemerintah, mitra swasta, dan pihak lainnya.Mau Berwirausaha? ada EHub sekarang berwirausaha jadi Mudah
            <br/><br/>
            Wirausaha Hebat, Indonesia Kuat
        </p>
        <div class="flex flex-row items-center gap-4 font-semibold">
            <a href="{{ route('home.about-us') }}" class="text-base md:text-lg text-secondary">Pelajari Lebih Lanjut</a>
            <ion-icon name="arrow-forward-outline" class="text-secondary font-semibold"></ion-icon>
        </div>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10">
    <div class="flex flex-col items-center">
        <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8 text-center">Langkah Berwirausaha dengan Mudah</h3>
        <p class="text-center text-base md:text-lg text-medium max-md:mb-6">Kata siapa berwirausaha itu sulit? padahal berwirausaha itu mudah loh! Mari kita ikuti langkah mudah untuk menjadi wirausaha hebat</p>
    </div>
    <div class="md:mt-10">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 xl:gap-16">
        @foreach($entrepreneur_steps as $entrepreneur_step)
        <a href="{{ route('home.entrepreneur-step', $entrepreneur_step->slug) }}" class="flex flex-col items-center text-center shadow-xl rounded-xl">
            <img class="w-full h-[400px] object-cover rounded-t-xl" src="{{ $entrepreneur_step->image }}" alt="{{ $entrepreneur_step->title }}" />
            <h4 class="font-semibold text-lg md:text-xl py-5 px-3 w-full">{{ $entrepreneur_step->title }}</h4>
        </a>
        @endforeach
        </div>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 splide" id="mentor-section">
    <div class="flex flex-col items-center">
        <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8 text-center">Konsultasikan Bisnismu</h3>
        <p class="text-center text-base md:text-lg text-medium">#SobatEntrepreneur bingung caranya untuk mengembangkan bisnis? EHub menyediakan ruang konsultasi dimana para wirausaha dapat mengajukan pertanyaan ke mentor profesional. EHub akan menjadi penghubung calon wirausaha atau wirausaha kepada pihak yang dibutuhkan atau dapat menunjang kegiatan usaha yang meliputi aspek legalitas, distribusi, produksi, pemasaran, pendanaan, dan pemasaran.</p>
    </div>
    <div class="md:mt-6">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($mentors as $mentor_key => $mentor)
                <li class="splide__slide">
                    <div class="flex flex-row gap-x-4 md:gap-x-6 p-4 md:p-6 rounded-2xl shadow-xl my-8 md:my-10 w-full max-h-[356px]">
                        <div class="flex w-6/12">
                            <img class="w-full h-[280px] md:h-[300px] object-cover rounded mentor-photo-{{ $mentor_key }}" src="{{ $mentor->avatar_url }}" onerror="this.src='{{ $mentor->gender == 'male' ? asset('images/avatar-boy.png') : asset('images/avatar-girl.png') }}'" />
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

    <div class="flex justify-center items-center">
        <a href="{{ route('mentors.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
            <span class="text-white md:font-semibold">Cek Semua Mentor</span>
            <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
        </a>
    </div>
</section>

<section class="hidden max-md:mb-10 lg:flex flex-col mx-auto  max-md:py-6 md:py-8 lg:py-10 xl:py-10 mb-16 md:mb-0">
    <h2 class="text-xl md:text-4xl text-primary font-bold text-center">Pelatihan Wirausaha</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 py-8 md:py-12">
        @foreach($workshops as $workshop)
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
    <div class="flex justify-center items-center">
        <a href="{{ route('workshops.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
        <span class="text-white md:font-semibold">Cek Semua Program</span>
        <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
        </a>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 splide visible lg:hidden" id="program-section">
    <div class="flex flex-col items-center gap-6">
        <h2 class="text-xl md:text-4xl text-primary font-bold text-center">Pelatihan Wirausaha</h3>
    </div>
    <div class="mt-6 md:mt-10">
        <div class="splide__track">
            <ul class="splide__list">
            @foreach($workshops as $workshop)
                <li class="splide__slide">
                    <div class="flex my-10 flex-col rounded-2xl overflow-hidden shadow-xl">
                        <img class="w-auto h-[411px] object-cover" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" />
                        <div class="px-6 pt-6 pb-8 flex-1">
                        <div class="flex flex-col h-full justify-between">
                            <div class="flex flex-col items-start">
                            <div class="flex flex-row items-center gap-2">
                                <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                                <span>{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
                            </div>
                            <div class="flex flex-wrap gap-1 py-2">
                                @foreach($workshop->hasTags as $tag)
                                <span class="bg-gray-200 rounded-full px-3 py-1 text-xs md:text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <h4 class="font-bold text-xl mb-4">{{ $workshop->title }}</h4>
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
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex justify-center items-center md:mt-6">
        <a href="{{ route('workshops.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
            <span class="text-white md:font-semibold">Cek Semua Program</span>
            <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
        </a>
    </div>
</section>

@if($news->isNotEmpty())
<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10">
    <h2 class="text-xl md:text-4xl text-primary font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-[#2C5165] from-10% to-[#9DA960] to-90%">Kabar Terkini</h3>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-7 pt-10 md:pt-[48px]">
        <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
            <img class="w-auto h-40 md:min-h-[600px] object-cover" src="{{ $news[0]->url_thumbnail }}" alt="{{ $news[0]->title }}" />
            <div class="px-6 py-4 md:pt-6 md:pb-8 flex-1">
                <div class="flex flex-col gap-3 h-full justify-between">
                    <div class="flex flex-wrap gap-2">
                        @foreach($news[0]->hasTags->take(2) as $tag)
                            <span class="text-[#9CA3AF]">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('news.detail', $news[0]->slug) }}">
                        <h5 class="text-[#111827] text-xl font-semibold">{{ $news[0]->title }}</h5>
                    </a>
                    <div class="line-clamp-4">
                        <p class="text-gray-700 font-medium ">{!! $news[0]->content !!}</p>
                    </div>
                    <span class="text-[#9CA3AF] text-sm md:text-base">{{ format_date($news[0]->created_at, 'D MMMM Y') }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-7">
            @foreach($news->slice(1, 3) as $news_item)
                <figure class="md:flex rounded-xl shadow-xl">
                    <img class="w-full md:w-48 h-40 md:h-auto rounded-t-xl md:rounded-l-xl mx-auto object-cover" src="{{ $news_item->url_thumbnail }}" alt="{{ $news_item->title }}" />
                    <div class="px-6 py-4 md:py-3 text-left space-y-4">
                        <div class="flex flex-col gap-3 h-full justify-between">
                            <div class="flex flex-wrap gap-2">
                                @foreach($news_item->hasTags->take(2) as $tag)
                                    <span class="text-[#9CA3AF]">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <a href="{{ route('news.detail', $news_item->slug) }}">
                                <h5 class="text-[#111827] text-xl font-semibold">{{ $news_item->title }}</h5>
                            </a>
                            <div class="line-clamp-3">
                                <p class="text-gray-700 font-medium ">{!! $news_item->content !!}</p>
                            </div>
                            <span class="text-[#9CA3AF] text-sm md:text-base">{{ format_date($news_item->created_at, 'D MMMM Y') }}</span>
                        </div>
                    </div>
                </figure>
            @endforeach
            <a href="{{ route('news.index') }}" class="flex flex-row justify-center items-center gap-2 btn btn-lg btn-block btn-secondary">
                <span class="text-white md:font-semibold">Cek selengkapnya</span>
                <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
            </a>
        </div>
    </div>
</section>
@endif

<section class="mx-auto max-md:mb-10 max-md:py-6 md:py-8 lg:py-10 xl:py-10 hidden lg:block">
    <div class="flex flex-col items-center">
        <h2 class="text-xl md:text-4xl text-primary font-bold md:mb-8 text-center">Kolaborator EntrepreneurHub</h3>
        <p class="text-center text-base md:text-lg text-medium">Ayo berkolaborasi dengan berbagai pihak dari kementerian, lembaga, komunitas, platfrom, dan enabler yang siap menunjang kegiatan wirausaha yang meliputi aspek legalitas, distribusi, produksi, pemasaran, pendanaan, dan pemasaran.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-7 md:pt-12 md:pb-14">
        @foreach($collaborators as $collaborator_key => $collaborator)
        <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
            <img class="w-full max-h-[200px] object-cover" src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}" alt="{{ $collaborator->name }}" />
            <div class="flex flex-col px-5 py-6 flex-1">
                <div class="flex flex-row gap-4 items-center mb-6">
                    <img class="w-12 h-12 object-cover" src="{{ $collaborator->logo_url }}" alt="{{ $collaborator->name }}" />
                    <h5 class="font-bold text-xl text-[#0F1010]">{{ $collaborator->name }}</h5>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col h-full justify-between">
                        <div class="flex flex-col gap-2 mb-6">
                            <div class="flex gap-2 py-1 text-white text-sm collaborator-hasTags-{{ $collaborator_key }}">
                                @foreach ($collaborator->hasTags->take(2) as $tag)
                                    <span class="bg-secondary text-sm py-1 px-2 rounded-lg">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <div class="line-clamp-3">
                                <p class="text-sm">{!! $collaborator->description !!}</p>
                            </div>
                        </div>
                        <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'workshops']) }}" class="btn btn-lg btn-block btn-outline-primary">Lihat Detail Kolaborator</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-center items-center">
        <a href="{{ route('umkm.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
            <span class="text-white md:font-semibold">Telusuri Kolaborator Lainnya</span>
            <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
        </a>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 splide visible lg:hidden" id="collaborator-section">
    <div class="flex flex-col items-center">
        <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8 text-center">Kolaborator EntrepreneurHub</h3>
        <p class="text-center text-base md:text-lg text-medium">Ayo berkolaborasi dengan berbagai pihak dari kementerian, lembaga, komunitas, platfrom, dan enabler yang siap menunjang kegiatan wirausaha yang meliputi aspek legalitas, distribusi, produksi, pemasaran, pendanaan, dan pemasaran.</p>
    </div>
    <div class="md:mt-10 px-0 md:px-16">
        <div class="splide__track">
            <ul class="splide__list">
            @foreach($collaborators as $collaborator_key => $collaborator)
            <li class="splide__slide">
                <div class="flex flex-col rounded-2xl my-10 overflow-hidden shadow-lg">
                    <img class="w-full max-h-[200px] object-cover" src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}" alt="{{ $collaborator->name }}" />
                    <div class="flex flex-col px-5 py-6 flex-1">
                        <div class="flex flex-row gap-4 items-center mb-6">
                            <img class="w-12 h-12 object-cover" src="{{ $collaborator->logo_url }}" alt="{{ $collaborator->name }}" />
                            <h5 class="font-bold text-xl text-[#0F1010]">{{ $collaborator->name }}</h5>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-col h-full justify-between">
                                <div class="flex flex-col gap-2 mb-6">

                                    <div class="flex gap-2 py-1 text-white text-sm collaborator-hasTags-{{ $collaborator_key }}">
                                        @foreach ($collaborator->hasTags->take(2) as $tag)
                                            <span class="bg-secondary text-sm py-1 px-2 rounded-lg">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="line-clamp-3">
                                        <p class="text-sm">{!! $collaborator->description !!}</p>
                                    </div>
                                </div>
                                <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'workshops']) }}" class="btn btn-lg btn-block btn-outline-primary">Lihat Detail Kolaborator</a>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex justify-center items-center">
        <a href="{{ route('umkm.index') }}" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary">
            <span class="text-white md:font-semibold">Telusuri Kolaborator Lainnya</span>
            <ion-icon name="arrow-forward-outline" class="text-white md:font-semibold"></ion-icon>
        </a>
    </div>
</section>

<section class="mx-auto  max-md:py-6 md:py-8 lg:py-10 xl:py-10 flex flex-col py-8 z-90">
    <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Entrepreneur Hub Corner</h3>
    <div class="flex flex-col lg:flex-row w-full gap-x-8 md:mt-6 flex-1">
        <div class="w-full lg:w-4/12 justify-center flex flex-col border-r-2 border-primary ">
            <div class="items-center text-right px-8 pr-8 flex flex-1">
                <h1 class="text-2xl md:text-3xl text-secondary text-right font-bold mb-4">"Wirausaha Muda: Kuat, Kreatif, dan Berdaya!"</h1>
            </div>
            <div class="justify-end items-end pr-8 md:pb-8 inline-block">
                <p class="relative text-sm pb-2 pr-6 font-semibold text-primary text-end">Kunjungi Entrepreneur Hub Corner <ion-icon class="text-xl absolute right-0 top-0" name="caret-forward-outline"></ion-icon></p>
            </div>
        </div>
        <div class="flex flex-col w-full lg:w-8/12">
            <div id="corner-section" class="splide px-4 md:px-16">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                        <a href="{{ route('corner.webinar1') }}" target="_blank">
                        <div class="cursor-pointer max-w-sm mx-auto rounded-2xl shadow-lg overflow-hidden my-10">
                            <div class="relative">
                                <img class="w-full brightness-50 hover:brightness-100" src="{{ asset('images/corner-2.jpg') }}" alt="Thumbnail 1">
                                <ion-icon class="bg-white p-2 rounded-full absolute left-[50%] top-[50%] text-xl pt-2" name="caret-forward-outline"></ion-icon>
                            </div>
                            <div class="px-6 py-4">
                                <div class="text-md text-gray-700 mb-2">Marketing</div>
                                <p class="font-bold text-xl mb-2">Literasi Wirausaha untuk Mempersiapkan Pebisnis Handal</p>
                                <div class="line-clamp-4">
                                    <p class="text-gray-700 text-sm">Dengan memiliki literasi wirausaha yang kuat, individu dapat mengenali peluang bisnis, mengelola resiko, mengembangkan rencana bisnis yang efektif dan ...</p>
                                </div>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="splide__slide">
                        <a href="{{ route('corner.webinar2') }}" target="_blank">
                        <div class="cursor-pointer max-w-sm mx-auto rounded-2xl overflow-hidden shadow-lg my-10">
                            <div class="relative">
                                <img class="w-full brightness-50 hover:brightness-100" src="{{ asset('images/corner-1.jpg') }}" alt="Thumbnail 2">
                                <ion-icon class="bg-white p-2 rounded-full absolute left-[50%] top-[50%] text-xl pt-2" name="caret-forward-outline"></ion-icon>
                            </div>
                            <div class="px-6 py-4">
                                <p class="text-md text-gray-700 mb-2">Marketing</p>
                                <p class="font-bold text-xl mb-2">Memulai Usaha dengan Membangun Personal Branding</p>
                                <div class="line-clamp-4">
                                    <p class="text-gray-700 text-sm">Dengan membangun personal branding yang kuat, kita dapat membedakan diri kita dari pesaing, membangun reputasi yang positif, dan menarik pelanggan potensial.</p>
                                </div>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="splide__slide">
                        <a href="{{ route('corner.webinar3') }}" target="_blank">
                        <div class="cursor-pointer max-w-sm mx-auto rounded-2xl overflow-hidden shadow-lg my-10">
                            <div class="relative">
                                <img class="w-full brightness-50 hover:brightness-100" src="{{ asset('images/corner-3.png') }}" alt="Thumbnail 3">
                                <ion-icon class="bg-white p-2 rounded-full absolute left-[50%] top-[50%] text-xl pt-2" name="caret-forward-outline"></ion-icon>
                            </div>
                            <div class="px-6 py-4">
                                <p class="text-md text-gray-700 mb-2">Marketing</p>
                                <p class="font-bold text-xl mb-2">Strategi Pemasaran Jitu dengan Artificial Intelligence</p>
                                <div class="line-clamp-4">
                                    <p class="text-gray-700 text-sm">Dengan mempelajari cara memanfaatkan kecerdasan buatan, kita dapat merancang kampanye pemasaran yang tepat sasaran sehingga proses pemasaran berjalan lebih efisien.</p>
                                </div>
                            </div>
                        </div>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-md:mb-10  px-4 max-md:py-6 md:py-8 lg:py-10 xl:py-10">
<div class="flex flex-row items-center justify-between mb-11">
        <div class="flex flex-col w-auto md:w-[600px]">
            <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Apa Kata Mereka?</h2>
            <span class="text-base md:text-lg text-medium">Berikut para alumni EntrepreneurHub dan testimoni dari para kolaborator yang terlibat di EntrepreneurHub</span>
        </div>
        <div class="hidden md:flex flex-row gap-3">
            <button type="button" id="btnPrev" class="flex justify-center items-center border border-[#D1D5DB] rounded-lg p-2">
                <ion-icon name="chevron-back-outline" class="text-primary"></ion-icon>
            </button>
            <button type="button" id="btnNext" class="flex justify-center items-center border border-[#D1D5DB] rounded-lg p-2">
                <ion-icon name="chevron-forward-outline" class="text-primary"></ion-icon>
            </button>
        </div>
    </div>
    <div id="testimonial-slider" class=" splide max-w-[320px] sm:max-w-[580px] md:max-w-[768px] xl:max-w-[1288px] mx-auto">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($testimonials as $testimonial)
                <li class="splide__slide">
                    <div class="flex flex-col mb-8 md:flex-row items-center gap-6 border border-[#D1D5DB] rounded-xl p-4 md:p-3 mx-2">
                        <div class="overflow-hidden w-24 md:w-24 h-auto border border-secondary shadow-lg rounded-xl">
                            <img class="w-full h-auto max-h-[130px] object-fill" src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" />
                        </div>
                        <div class="flex flex-1 flex-col">
                            <span class="text-[#111827] mb-1 font-semibold">{{ $testimonial->name }}</span>
                            <span class="text-sm text-[#9CA3AF] mb-3">{{ $testimonial->position }}</span>
                            <p class="text-left text-sm text-[#111827]">{{ $testimonial->content }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="mx-auto max-md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10">
    <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-2 md:gap-8">
        <img class="hidden md:flex absolute z-[-10] -ml-40 bottom-0 w-[350px] h-auto object-contain" src="{{ asset('images/pattern-gradient.png') }}" alt="Pattern Gradient" />
        <div class="flex flex-col">
            <h2 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8">Pertanyaan Umum</h2>
            <span class="text-base md:text-lg text-medium mb-6">Berikut ini adalah daftar pertayaan yang paling sering ditanyakan terkait EntrepreneurHub</span>
        </div>
        <div class="flex flex-col gap-8">
            @foreach($faqs as $faq)
                <div class="flex flex-col shadow-xl p-4 md:p-8 rounded-xl">
                    <div class="accordion cursor-pointer flex flex-row items-center w-full gap-4 justify-between">
                        <h5 class="w-11/12 text-lg md:text-xl text-[#1F2937] font-bold">{{ $faq->question }}</h5>
                        <div class="accordion-wrapper-icon flex justify-center items-center rounded-full h-8 w-8 md:w-10 md:h-10 border border-primary transition duration-500">
                            <ion-icon name="chevron-down-outline" class="accordion-icon text-primary -rotate-90 text-lg md:text-xl transition duration-500"></ion-icon>
                        </div>
                    </div>
                    <p class="max-h-0 overflow-hidden transition-all duration-500">{{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="mx-auto md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 hidden md:block" id="partnerSection">
    <h3 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8 text-center">Partner EntrepreneurHUB</h3>
    <div id="partner-section" class="splide px-16">
        <div class="splide__track">
            <ul class="splide__list">
            @foreach($partners as $partner)
                <li class="splide__slide flex items-center">
                    <img class="h-auto max-h-24 max-md:pt-2 w-20 object-contain justify-self-center" src="{{ $partner->logo }}" alt="{{$partner->name}}" />
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="mx-auto md:mb-10  max-md:py-6 md:py-8 lg:py-10 xl:py-10 visible md:hidden" id="partnerSection">
    <h3 class="text-xl md:text-4xl text-primary font-bold mb-6 md:mb-8 text-center">Partner EntrepreneurHUB</h3>
    <div class="grid grid-cols-2 md:grid-cols-9 w-12/12 gap-2 md:gap-7 py-[24px] md:py-[24px] items-center" id="partnerImages">
        @foreach($partners as $index => $partner)
            @if($index < 8)
                <img class="h-auto max-h-24 max-md:pt-2 w-20 object-contain justify-self-center item" src="{{ $partner->logo }}" alt="{{ $partner->name }}" />
            @else
                <img class="h-auto max-h-24 max-md:pt-2 w-20 object-contain justify-self-center item hiddenStyle" src="{{ $partner->logo }}" alt="{{ $partner->name }}" />
            @endif
        @endforeach
    </div>
    <div class="flex justify-center items-center">
        <button id="loadMore" class="w-80 md:w-1/2 flex flex-row justify-center items-center gap-2 btn btn-lg btn-secondary text-white">Lihat Semua</button>
    </div>
</section>

<div class="modal fixed z-50 w-full h-full top-0 left-0 flex items-center justify-center transition ease-in-out duration-500 opacity-0 pointer-events-none">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div id="modal-container" class="modal-container bg-white w-11/12 md:w-auto mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex flex-row items-center justify-between modal-header mb-3 text-xl font-semibold">
                <div>EnterpreneurHub</div>
                <ion-icon class="modal-close-button text-3xl cursor-pointer" name="close-outline"></ion-icon>
            </div>
            <div class="modal-body">
                <iframe
                width="700"
                height="450"
                src="https://www.youtube.com/embed/BWJ6pRjJ42o?modestbranding=1&rel=0"
                title="YouTube video player"
                frameborder="0"
                allowfullscreen
                class="w-full max-tablet-nest:h-[150px] tablet-nest:h-[220px] tablet-nest-max:h-[300px] sm:h-[360px] md:w-[700px] md:h-[450px]"
                >
                </iframe>
            </div>
        </div>
    </div>
</div>

<a href="https://wa.me/6282170003482" target="_blank" class="flex flex-row gap-2 items-center fixed bottom-4 right-4 z-50">
    <div class="px-3 py-1 bg-white rounded shadow-md">Live Chat</div>
    <img class="h-20 w-auto object-contain" src="{{ asset('images/icon-wa.png') }}" alt="Logo WhatsApp" />
</a>

@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
    var loadMore = document.getElementById("loadMore");
    var hiddenItems = document.querySelectorAll(".hiddenStyle");
    loadMore.addEventListener("click", function () {
        hiddenItems.forEach(function (item) {
            item.classList.remove("hiddenStyle");
        });
        loadMore.style.display = "none";
    });
</script>

<script>
// init splide on hero section
new Splide('#hero-slider', {
    arrows: false,
    fixedHeight: '540px',
    autoplay: true,
    type: 'loop',
    interval: 4000,
    pauseOnHover: true,
    perPage: 1,
    breakpoints: {
    1024: {
        fixedHeight: 450,
    },
    768: {
        fixedHeight: 350,
    },
    640: {
        fixedHeight: 210,
    },
    480: {
        fixedHeight: 180,
    },
    410: {
        fixedHeight: 150,
    },
    360: {
        fixedHeight: 100,
    },

    },
}).mount();

let splide; // Declare the splide variable here

    document.addEventListener('DOMContentLoaded', function() {
    // init splide on testimonial section and store the instance in the splide variable

    splide = new Splide('#testimonial-slider', {
        type: 'loop',
        arrows: false,
        pagination: true,
        autoplay: true,
        interval: 4000,
        drag: true,
        perPage: 2,
        breakpoints: {
            1280: {
                perPage: 1
            }
        }
    }).mount();

    // Attach events to custom buttons
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');

    btnNext.addEventListener('click', () => {
        splide.go('+1');
    });

    btnPrev.addEventListener('click', () => {
        splide.go('-1');
    });
});

new Splide("#mentor-section", {
    autoplay: true,
    pagination: false,
    type: 'loop',
    perMove: 1,
    gap: '1.5rem',
    perPage: 3,
    breakpoints: {
        1280: {
            perPage: 2,
        },
        1024: {
            perPage: 1,
        }
    }
}).mount();

new Splide("#collaborator-section", {
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
        768: {
            perPage: 1
        },
    }
}).mount();

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
        768: {
            perPage: 1
        },
    }
}).mount();

new Splide('#corner-section', {
    autoplay: true,
    pagination: false,
    type: 'loop',
    perMove: 1,
    gap: '1.5rem',
    perPage: 2,
    breakpoints: {
        1280: {
            perPage: 1
        },

    }
    }).mount();

    new Splide('#partner-section', {
    autoplay: true,
    pagination: false,
    type: 'loop',
    perMove: 1,
    gap: '1.5rem',
    perPage: 9,
    breakpoints: {
        1024: {
        perPage: 6,
        },
        768: {
            perPage: 6
        },
        576: {
            perPage: 3
        }
    }
    }).mount();

// modal video embeded
const openModalBtn = document.getElementById('open-modal-btn');
const modal = document.querySelector('.modal');
const closeModalBtn = document.querySelector('.modal-close-button');
const modalContainer = document.getElementById('modal-container')

openModalBtn.addEventListener('click', () => {
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');
});

closeModalBtn.addEventListener('click', () => {
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
});

modal.addEventListener('click', (event) => {
    const isInsideModal = modalContainer.contains(event.target);

    if (!isInsideModal) {
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
    }
});

// event collapsed on FAQ section
const accordions = document.getElementsByClassName("accordion");

[...accordions].forEach(accordion => {
    accordion.addEventListener("click", function() {

    const panel = this.nextElementSibling;
    const wrapperIcon = this.querySelector(".accordion-wrapper-icon");
    const icon = wrapperIcon.querySelector(".accordion-icon");

    const isCollapsed = !panel.style.maxHeight;

    if (isCollapsed) {
        panel.style.maxHeight = panel.scrollHeight + "px";
        panel.style.marginTop = "16px";
        wrapperIcon.classList.remove("border", "border-primary");
        wrapperIcon.classList.add("bg-primary");
        icon.classList.toggle("-rotate-90");
        icon.classList.toggle("text-primary");
        icon.classList.toggle("text-white");
    } else {
        panel.style.maxHeight = null;
        panel.style.marginTop = null;
        wrapperIcon.classList.remove("bg-primary");
        wrapperIcon.classList.add("border", "border-primary");
        icon.classList.toggle("-rotate-90");
        icon.classList.toggle("text-primary");
        icon.classList.toggle("text-white");
    }
    });
});

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
