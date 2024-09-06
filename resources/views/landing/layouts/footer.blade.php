@if (!request()->is('workshops/update-data'))
    <div
        class="max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl mx-auto flex flex-row relative gap-0 md:gap-11 py-20 px-4 md:px-8 rounded-tl-2xl rounded-tr-2xl bg-gradient-to-r from-primary from-5% to-[#8AAF4A] to-95% mt-16 md:mt-10">
        <div class="overflow-hidden">
            <img class="absolute left-0 bottom-0 h-full w-full object-cover"
                src="{{ asset('images/pattern-circle.png') }}" alt="Pattern Circle" />
        </div>
        <img class="hidden md:flex absolute -left-12 bottom-0 md:h-[400px] lg:h-[471px] w-auto object-contain"
            src="{{ asset('images/hero-footer-person.png') }}" alt="Illus Man" />
        <div class="flex flex-col gap-8 md:gap-8 lg:gap-14 pl-2 md:pl-64 lg:pl-96 z-20 items-center md:items-start">
            <div
                class="font-bold text-white tablet-fold:text-xl min-[375px]:text-2xl lg:text-4xl xl:text-6xl md:text-xl text-center md:text-left">
                Yuk Gabung di Ekosistem
                EntrepreneurHub Sekarang!</div>
            <a href="{{ route('register') }}" class="btn px-4 py-3 md:btn-lg btn-secondary max-w-[324px]">Bergabung di
                EntrepreneurHub</a>
        </div>
    </div>
@endif

<div
    class="flex flex-col lg:flex-row gap-8 lg:gap-32 bg-[#13455E] md:-mx-[76px] px-4 md:px-[76px] text-white py-16 mb-10 rounded-b-2xl md:rounded-none md:mb-0 md:py-28">
    <div class="flex flex-col gap-10">
        <a href="{{ route('home.index') }}"> <img class="w-52" src="{{ asset('images/white-ehub-logo.png') }}"
                alt="Logo EnterpreneurHub" />
        </a>
        <p>Jl. H. R. Rasuna Said No.Kav. 3-4, RT.6/RW.7, Kuningan, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta
            Selatan, Daerah Khusus Ibukota Jakarta 12940</p>
    </div>

    <div class="whitespace-nowrap">
        <h3 class="font-bold mb-5">Quick Links</h3>
        <ul class="flex flex-col gap-4">
            <li>
                <a href="{{ route('home.contact-us') }}" class="hover:underline hover:decoration-white">Kontak Kami</a>
            </li>
        </ul>
    </div>

    <div class="whitespace-nowrap">
        <h3 class="font-bold mb-5">Contact Us</h3>
        <ul class="flex flex-col gap-4">
            <li class="flex items-center gap-4 md:gap-7">
                <ion-icon name="mail-outline" class="text-xl"></ion-icon>
                <a href="mailto:ekobis.kwu@gmail.com"
                    class="hover:underline hover:decoration-white overflow-hidden text-clip">ekobis.kwu@gmail.com</a>
            </li>
            <li class="flex items-center gap-4 md:gap-7">
                <ion-icon name="logo-youtube" class="text-xl"></ion-icon>
                <a href="https://youtube.com/@EHub_Channel" target="_blank"
                    class=" hover:underline hover:decoration-white overflow-hidden text-clip">@EHub_Channel</a>
            </li>
            <li class="flex items-center gap-4 md:gap-7">
                <ion-icon name="logo-instagram" class="text-xl"></ion-icon>
                <a href="https://instagram.com/ehub.go.id/" target="_blank"
                    class="hover:underline hover:decoration-white overflow-hidden text-clip">@ehub.go.id</a>
            </li>
        </ul>
    </div>
</div>
