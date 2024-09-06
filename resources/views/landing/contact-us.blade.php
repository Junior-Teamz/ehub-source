@extends('landing.layouts.app')
@section('extra-title') Kontak Kami @endsection

@section('page-title')
    <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
        <h1 class="text-white">Kontak Kami</h1>
    </div>
@endsection

@section('content')
    <section class="mt-[72px] mb-40">
        <div class="flex xl:flex-row max-xl:gap-16 flex-col-reverse justify-center gap-10">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.34899438059!2d106.8307486!3d-6.2191818!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f79a35f997%3A0x3877c5bc98573b28!2sKementerian%20Koperasi%20dan%20Usaha%20Kecil%20dan%20Menengah%20Republik%20Indonesia!5e0!3m2!1sid!2sid!4v1681438494907!5m2!1sid!2sid"
                class="w-[740px] h-[465px] max-xl:w-full" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="flex flex-col gap-5 w-full">
                <div class="flex justify-start">
                    <img class="h-[80px] w-auto object-contain" src="{{ asset('images/logo-ehub-new.png') }}"
                        alt="pelaku-usaha" />
                </div>
                <p class="font-bold text-2xl text-secondary mt-2"> Hubungi Kami </p>
                <div class="flex flex-row gap-4">
                    <img class="h-[19.2px] w-[16.8px] mt-[2.4px] ml-[3.6px] object-contain justify-self-center fill-primary"
                        src="{{ asset('images/contact/office.png') }}" alt="Logo Kominfo" />
                    <p class="text-base font-medium text-primary">Jl. H. R. Rasuna Said No.Kav. 3-4, RT.6/RW.7, Kuningan,
                        Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12940</p>
                </div>
                <div class="flex flex-row gap-4 items-center">
                    <ion-icon name="mail-outline" class="text-primary text-xl"></ion-icon>
                    <a href="mailto:ekobis.kwu@gmail.com"
                        class="text-base font-medium text-primary">ekobis.kwu@gmail.com</a>
                </div>
                <div class="flex flex-row gap-4 items-center">
                    <ion-icon name="logo-youtube" class="text-primary text-xl"></ion-icon>
                    <a href="https://www.youtube.com/@EHub_Channel" target="blank"
                        class="text-base font-medium text-primary">@Ehub_Channel</a>
                </div>
                <div class="flex flex-row gap-4 items-center">
                    <ion-icon name="logo-instagram" class="text-xl text-primary"></ion-icon>
                    <a href="https://instagram.com/ehub.go.id" target="blank"
                        class="text-base font-medium text-primary">@ehub.go.id</a>
                </div>
            </div>
        </div>
    </section>
@endsection
