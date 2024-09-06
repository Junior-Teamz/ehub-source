@extends('landing.layouts.app')
@section('extra-title') Tentang Kami @endsection

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
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

@section('page-title')
    <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
        <h1 class="text-white">Tentang Kami</h1>
    </div>
@endsection

@section('content')
<section class="flex flex-row mt-[72px] max-md:mb-20 mb-[29px] mx-auto mb-20 max-sm:max-w-[375px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl px-4 sm:px-6 md:px-8 lg:px-10 xl:px-10 justify-center">
    <div class="flex flex-col justify-center ">
    <h2 class="text-center text-4xl mb-8 font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960]">
        Apa EntrepreneurHub Itu?
    </h2>
    <div class="flex flex-row">
        <div class="flex flex-grow"></div>
            <p class="text-center text-base md:text-lg text-medium w-full md:w-11/12 lg:w-9/12 mb-6">
                EntrepreneurHub merupakan Platform Ekosistem Wirausaha Indonesia yang mengintegrasikan berbagai kementrian Lembaga dan Pemangku Kepentingan serta Pelaku UMKM. Dengan tujuan untuk memperkuat ekosistem kewirausahaan seperti Pendataan, Pemetaan, Klasterisasi serta fitur lainnya
            </p>
            <div class="flex flex-grow"></div>
        </div>
    <img id="open-modal-btn" class="rounded-xl w-full h-fit  object-contain cursor-pointer" src="{{ asset('images/illus-female.png') }}" alt="Illus Female" />
    </div>
</section>

<section class="mx-auto my-20 max-sm:max-w-[375px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl px-4 sm:px-6 md:px-8 lg:px-10 xl:px-10 hidden md:block" id="partnerSection">
    <h3 class="text-primary text-4xl text-center font-semibold mb-10">Partner EntrepreneurHUB</h3>
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

<section class="mx-auto mb-20 max-sm:max-w-[375px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl px-4 sm:px-6 md:px-8 lg:px-10 xl:px-10 visible md:hidden" id="partnerSection">
    <h3 class="text-primary text-4xl text-center font-semibold">Partner EntrepreneurHUB</h3>
    <div class="grid grid-cols-2 md:grid-cols-9 w-12/12 gap-2 md:gap-7 py-[40px] md:py-[72px] items-center" id="partnerImages">
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

<section class="mb-20 mx-auto mb-20 max-sm:max-w-[375px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl px-4 sm:px-6 md:px-8 lg:px-10 xl:px-10">
    <h3 class="text-primary text-4xl text-center font-bold mb-[54px]">Ekosistem EntrepeneurHub</h3>
    <div class="mx-auto flex flex-row max-xl:flex-col gap-8 items-left max-xl:items-center ">
        <div class="w-full rounded-xl bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960] p-[1px]">
            <div class="flex flex-col h-full w-full p-7 rounded-xl items-left bg-gray-50 back">
                <div class="flex md:flex-row max-md:justify-start max-md:items-start flex-col gap-6">
                    <img class="h-[56px] w-auto object-contain justify-self-center" src="{{ asset('images/frame-1.png') }}" alt="Logo Kemenko" />
                    <p class="text-xl font-bold text-primary">Di EntrepreneurHub, semua progam kewirausahaan ada</p>
                </div>
                <p class="text-sm font-medium my-7">Kami memenuhi kebutuhan pelaku usaha untuk mendapatkan program yang sesuai dengan kebutuhan</p>
            </div>
        </div>
    <div class="w-full rounded-xl bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960] p-[1px]">
        <div class="flex flex-col h-full w-full p-7 rounded-xl items-left  bg-gray-50 back">
            <div class="flex md:flex-row max-md:justify-start max-md:items-start flex-col gap-6">
                <img class="h-[56px] w-auto object-contain " src="{{ asset('images/frame-2.png') }}" alt="Logo Kemenko" />
                <p class="text-xl font-bold text-primary">Kami akan menghubungkan seluruh kebutuhan ekosistem wirausaha</p>
            </div>
            <p class="text-sm font-medium my-7">EntrepreneurHub akan menjadi  agregator ekosistem wirausaha yang menaungi seluruh pelaku usaha di Indonesia</p>
        </div>
    </div>
    <div class="w-full rounded-xl bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960] p-[1px]">
        <div class="flex flex-col h-full w-full p-7 rounded-xl items-left bg-gray-50 back">
            <div class="flex md:flex-row max-md:justify-start flex-col max-md:items-start gap-6">
                <img class="h-[56px] w-auto object-contain justify-self-center" src="{{ asset('images/frame-3.png') }}" alt="Logo Kemenko" />
                <p class="text-xl font-bold text-primary">Tempat berkumpulnya para pelaku usaha</p>
            </div>
            <p class="text-sm font-medium my-7">Seluruh jejaring wirausaha berkumpul di EntrepreneurHub yang akan mempermudah pelaku usaha berkolaborasi dan mengembangkan usahanya</p>
        </div>
    </div>
</section>

<section class="mx-auto mb-20 max-sm:max-w-[375px] sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl mb-20 py-3 md:py-[72px] max-w-[1288px] px-4 sm:px-6 md:px-8 lg:px-10 xl:px-10">
    <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between mb-11">
            <div class="flex flex-col gap-6 w-auto md:w-[600px]">
                <h2 class="font-semibold text-4xl text-primary">Apa Kata Mereka?</h2>
                <span class="text-lg text-[#6B7280]">Berikut para alumni EntrepreneurHub dan testimoni dari para kolaborator yang terlibat di EntrepreneurHub</span>
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
    <div id="testimonial-slider" class="splide">
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

    new Splide('#partner-section', {
    autoplay: true,
    pagination: false,
    type: 'loop',
    perMove: 1,

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
</script>
@endsection
