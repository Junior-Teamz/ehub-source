@extends('landing.layouts.app')

@section('content')
<hr class="max-lg:hidden"/>
<section class="mt-6">
<div class="flex flex-col lg:flex-row mt-2">
    <div class="flex flex-col w-8/12 max-xl:w-full pr-7 max-xl:pr-0">

        <p class="text-2xl font-bold">Strategi Pemasaran Jitu dengan Artificial Intelligence</p>
        <div class="my-4">
            <span class="text-base rounded-lg text-white p-2 bg-primary mb-3 ">Marketing</span>
        </div>
        <div class="flex flex-row items-center max-lg:items-start max-lg:flex-col">

            <div class="flex text-slate-600 py-1 max-lg:px-0  px-4 font-[12px] items-center mr-8">
                <ion-icon name="calendar-clear-outline" class="mr-2"  size="large" color="gray-600"></ion-icon>Selasa, 5 September 2023
            </div>
            <div class="flex text-slate-600 py-1 max-lg:px-0  px-4 font-[12px] items-center ">
                <ion-icon name="time-outline" class="mr-2"  size="large" color="gray-600"></ion-icon> 09.00-12.00 WIB
            </div>
        </div>
        <div class="flex mt-6">
            <p class="text-base font-bold">Deskripsi Program</p>
        </div>
        <div class="html-content flex flex-col mt-3">
            <p>Webinar "Strategi Pemasaran Jitu dengan Artificial Intelligence" adalah sebuah inisiatif yang akan membuka jendela ke dunia pemasaran modern yang didukung oleh kecerdasan buatan. Dalam acara ini, Anda akan mendapatkan wawasan mendalam tentang bagaimana teknologi AI mampu mengoptimalkan strategi pemasaran, meningkatkan retensi pelanggan, dan mengidentifikasi peluang bisnis yang tak tergoyahkan. Pemateri-pemateri ahli di bidang ini akan membagikan pengetahuan dan pandangan praktis tentang penggunaan AI dalam pemasaran, membantu Anda mengambil langkah cerdas untuk mencapai kesuksesan dalam dunia pemasaran yang kompetitif.</p>
            <br/>
            <p>Jangan lewatkan kesempatan ini untuk mengasah pengetahuan Anda tentang pemasaran dan AI.
        </div>
        <div class="flex mt-8">
            <p class="text-base font-bold">Pembicara</p>
        </div>
        <div class="flex flex-col mt-3 ml-6 gap-3">
            <div class="flex flex-row items-center">
                <img class="w-16 h-16 object-cover rounded-full" src="{{ asset('images/lia_sadia.jpg') }}" alt="Pemateri 1">
                <div class="flex flex-col pl-4">
                    <p class="font-semibold"> Lia Sadia </p>
                    <p class="text-gray-700"> CMO Remote Skills Academy </p>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <img class="w-16 h-16 object-cover rounded-full" src="{{ asset('images/siti_azizah.jpg') }}" alt="Pemateri 2">
                <div class="flex flex-col pl-4">
                    <p class="font-semibold"> Siti Azizah </p>
                    <p class="text-gray-700"> Deputi Bidang Kewirausahaan </p>
                </div>
            </div>
        </div>
        <div class="flex mt-8">
            <p class="text-base font-bold">Moderator</p>
        </div>
        <div class="flex flex-col mt-3 ml-6 gap-3">
            <div class="flex flex-row items-center">
                <img class="w-16 h-16 object-cover rounded-full" src="{{ asset('images/dinda_aulia.jpg') }}" alt="Pemateri 1">
                <div class="flex flex-col pl-4">
                    <p class="font-semibold"> Dinda Aulia </p>
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
            <img class="w-full brightness-50 hover:brightness-100" src="{{ asset('images/corner-3.png') }}" alt="Thumbnail 1">
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
                src="https://www.youtube.com/embed/oL9heYhbrF0?modestbranding=1&rel=0"
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
