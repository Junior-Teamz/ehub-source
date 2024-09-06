@extends('landing.layouts.app')

@section('content')
<hr class="max-lg:hidden"/>
<section class="mt-6">
<div class="flex flex-col lg:flex-row mt-2">
    <div class="flex flex-col w-8/12 max-xl:w-full pr-7 max-xl:pr-0">

        <p class="text-2xl font-bold">Literasi Wirausaha untuk Mempersiapkan Pebisnis Handal</p>
        <div class="my-4">
            <span class="text-base rounded-lg text-white p-2 bg-primary mb-3 ">Marketing</span>
        </div>
        <div class="flex flex-row items-center max-lg:flex-col max-lg:items-start">
            <div class="flex text-slate-600 py-1 max-lg:px-0 px-4 font-[12px] items-center mr-8">
                <ion-icon name="calendar-clear-outline" class="mr-2"  size="large" color="gray-600"></ion-icon>Rabu, 12 Juli 2023
            </div>
            <div class="flex text-slate-600 py-1 max-lg:px-0 px-4 font-[12px] items-center ">
                <ion-icon name="time-outline" class="mr-2"  size="large" color="gray-600"></ion-icon> 18:00 WIB
            </div>
        </div>
        <div class="flex mt-6">
            <p class="text-base font-bold">Deskripsi Program</p>
        </div>
        <div class="html-content flex flex-col mt-3">
            <p>Webinar ini akan memberikan pemahaman mendalam tentang konsep dan keterampilan yang diperlukan untuk menjadi seorang pebisnis yang handal. Kami akan menjelajahi berbagai aspek wirausaha, termasuk perencanaan bisnis, analisis pasar, strategi pemasaran, manajemen keuangan, serta pengembangan produk dan layanan. Dengan bimbingan ahli dan studi kasus yang relevan, webinar ini akan memberikan wawasan berharga bagi peserta untuk membangun dasar pengetahuan yang kokoh dalam dunia wirausaha dan meningkatkan kemampuan mereka dalam menghadapi tantangan bisnis yang kompleks.</p>
            <br/>
            <p>Bersiaplah untuk meningkatkan literasi wirausaha Anda dan menjadi seorang pebisnis yang handal dalam webinar ini. Ayo ikuti webinar ini dan mulai perjalanan Anda menuju keberhasilan dalam dunia wirausaha!
        </div>
        <div class="flex mt-8">
            <p class="text-base font-bold">Pembicara</p>
        </div>
        <div class="flex flex-col mt-3 ml-6 gap-3">
            <div class="flex flex-row items-center">
                <img class="w-16 h-16 object-cover rounded-full" src="https://ehub.kemenkopukm.go.id/storage/mentors/avatar/30/1691334274_IMG-20230806-WA0057.jpg" alt="Pemateri 1">
                <div class="flex flex-col pl-4">
                    <p class="font-semibold"> Isti Budhi Setiawati </p>
                    <p class="text-gray-700"> Cofounder Sidina Community, Akademisi </p>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <img class="w-16 h-16 object-cover rounded-full" src="https://ehub.kemenkopukm.go.id/storage/mentors/avatar/23/1691333234_IMG-20230806-WA0043.jpg" alt="Pemateri 2">
                <div class="flex flex-col pl-4">
                    <p class="font-semibold"> Wisnu Sakti Dewabroto </p>
                    <p class="text-gray-700"> Tenaga Ahli Deputi Kewirausahaan, Akademisi </p>
                </div>
            </div>
        </div>
        <div class="flex mt-8">
            <p class="text-base font-bold">Penyelenggara</p>
        </div>
        <div class="flex flex-row mt-3 ml-6">
            <img class="w-16" src="{{ asset('images/logo-kemenkop.png') }}" alt="Logo Kemenkop">
            <div class="flex flex-col pl-4">
                <p class="font-semibold"> Kemenkop UKM </p>
                <p class="text-gray-700"> Jakarta </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col overflow-hidden lg:mt-0 mt-8 h-full ">
        <div class="text-end text-gray-700 mb-2">Bagikan :</div>
        <div class="flex flex-row text-gray-700 mb-4 gap-2 text-lg justify-end">
            <button id="copyButton"><ion-icon name="share-social-outline"></ion-icon></button>
            <a id="whatsappShare" href="#" target="_blank" rel="noopener noreferrer"><ion-icon name="logo-whatsapp"></ion-icon></a>
            <a id="facebookShare" href="#" target="_blank" rel="noopener noreferrer"><ion-icon name="logo-facebook"></ion-icon></a>
            <a id="twitterShare" href="#" target="_blank" rel="noopener noreferrer"><ion-icon name="logo-twitter"></ion-icon></a>
        </div>
        <div class="relative cursor-pointer"  id="open-modal-btn">
            <img class="w-full brightness-50 hover:brightness-100" src="{{ asset('images/corner-2.jpg') }}" alt="Thumbnail 2">
            <ion-icon class="bg-white p-2 rounded-full absolute left-[50%] top-[50%] text-xl pt-2" name="caret-forward-outline"></ion-icon>
        </div>
    </div>
</div>
</section>

<div class="modal fixed z-50 w-full h-full top-0 left-0 flex items-center justify-center transition ease-in-out duration-500 opacity-0 pointer-events-none">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div id="modal-container" class="modal-container bg-white w-11/12 md:w-auto mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex flex-row items-center justify-between modal-header mb-3 text-xl font-semibold">
                <div>EnterpreneurHub Corner</div>
                <ion-icon class="modal-close-button text-3xl cursor-pointer" name="close-outline"></ion-icon>
            </div>
            <div class="modal-body">
                <iframe
                width="700"
                height="450"
                src="https://www.youtube.com/embed/lxxaseqbQ54?modestbranding=1&rel=0"
                title="YouTube video player"
                frameborder="0"
                allowfullscreen
                class="w-[320px] h-[320px] md:w-[700px] md:h-[450px]"
                >
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-js')
<script>
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
<script>
  const copyButton = document.getElementById('copyButton');

  copyButton.addEventListener('click', () => {
    const url = window.location.href;

    navigator.clipboard.writeText(url)
      .then(() => {
        alert('URL berhasil disalin!');
      })
      .catch((error) => {
        console.error('Gagal menyalin URL:', error);
      });
  });
</script>
<script>
  var currentUrl = window.location.href;
  var facebookShareLink = document.getElementById('facebookShare');
  var twitterShareLink = document.getElementById('twitterShare');
  var whatsappShareLink = document.getElementById('whatsappShare');

  facebookShareLink.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl);
  twitterShareLink.href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentUrl) + '&text=Kunjungi%20Entrepreneur%20Hub%20Disini%20Sekarang%21';
  whatsappShareLink.href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(currentUrl);
</script>


@endsection
