@extends('landing.layouts.app')
@section('extra-css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
@endsection

@section('content')
  <hr />

  <div class="flex flex-col w-full px-4">
    <section class="mb-10 md:mb-20 mt-4 md:mt-8">
      <div class="relative">
        <img class="w-full h-full object-cover rounded-2xl" src="{{ asset('images/business/managing/gambar-1-slider.jpg') }}" alt="Slider 1" />
        <div class="w-full h-full absolute left-0 top-0 px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 my-auto">
          <div class="flex flex-col items-start justify-start md:justify-center w-7/12 sm:w-6/12 lg:w-5/12 h-full">
            <h1 class="text-left text-lg sm:text-2xl md:text-4xl lg:text-5xl xl:text-6xl sm:leading-8 md:leading-[48px] lg:leading-[64px] xl:leading-[72px] my-auto font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#2C5165] via-[#7EA086] to-[#9DA960]">
              Mengelola Bisnis dan Menggapai Impian!
            </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="md:mb-20 mb-10">
      <div class="flex flex-col justify-center text-center px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16">
        <h2 class="text-xl md:text-4xl text-primary font-bold mb-4 sm:mb-6 md:mb-8">
        Yuk! #SobatEhub Kelola Usahamu!</h2>
        <div class="flex">
          <div class="flex flex-grow"></div>
          <p class="text-base md:text-lg w-10/12 md:w-8/12 text-medium mb-6">
            Mengelola bisnis adalah proses komprehensif dalam mengatur, mengelola, dan mengoptimalkan berbagai aspek bisnis Anda, termasuk keuangan, sumber daya manusia, pemasaran, operasional, dan strategi bisnis keseluruhan. Dengan pengelolaan bisnis yang baik #SobatEHub dapat mengidentifikasi peluang, mengatasi tantangan, membuat keputusan yang tepat, serta mencapai tujuan bisnismu agar sukses dan berkembang jangka panjang.
          </p>
          <div class="flex flex-grow"></div>
        </div>
      </div>
    </section>

    <section class="py-8">
      <div class="flex flex-col-reverse md:flex-row justify-between gap-10">
        <div class="flex flex-col">
          <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Kelola Keuangan Kamu</h2>
          <p class="text-base md:text-lg text-medium mb-6">
          Kelola keuangan usaha merupakan proses penting dalam mengatur, memantau, dan mengoptimalkan aspek keuangan bisnis #SobatEhub. Hal ini melibatkan pembuatan rencana keuangan, pemisahan keuangan pribadi dan bisnis, pencatatan transaksi, pengaturan anggaran, pengelolaan persediaan dan piutang, serta analisis keuangan rutin.
          <br /><br />Dengan mengelola keuangan bisnis dengan baik, Anda dapat menjaga stabilitas keuangan, mencegah pemborosan, meningkatkan profitabilitas, dan menciptakan fondasi yang kuat untuk pertumbuhan dan keberhasilan bisnismu Sob!
          </p>
        </div>
        <div class="splide w-96 md:w-4/12" id="finance-section">
          <div class="md:px-16">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($finances as $finance)
                  <li class="splide__slide relative">
                    <a href="{{ $finance->site }}" class="flex flex-col my-10">
                      <div class="w-full flex justify-center items-center mb-4">
                          <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center" src="{{ $finance->image }}" />
                      </div>
                      <p class="font-semibold text-xl text-center">{{ $finance->name }}</p>
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
      <div class="flex flex-col md:flex-row justify-between gap-10">
        <div class="splide w-96 md:w-4/12" id="sumberdayaSection">
          <div class="mb-10 md:px-16">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($resources as $resource)
                <li class="splide__slide relative">
                  <a href="{{ $resource->site }}" class="flex flex-col my-10">
                  <div class="w-full flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                    <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center" src="{{ $resource->image }}" />
                  </div>
                  <p class="font-semibold text-xl text-center">{{ $resource->name }}</p>
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="flex flex-col">
          <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Cari dan kelola SDM/tim bisnis!</h2>
          <p class="text-base md:text-lg text-medium mb-6">
            Pengelolaan sumber daya manusia (SDM) melibatkan pengaturan dan pengelolaan tenaga kerja dalam bisnis. Ini mencakup proses perekrutan, seleksi, pelatihan, pengembangan, dan pengelolaan karyawan secara keseluruhan. SDM bertujuan untuk memastikan bahwa bisnis memiliki tim yang berkualitas, terampil, dan termotivasi yang dapat mendukung tujuan dan kesuksesan bisnis.
            <br /><br />Dengan pengelolaan SDM yang efektif, bisnis dapat membangun budaya kerja yang positif, meningkatkan kinerja karyawan, memperkuat komunikasi dan kolaborasi, serta menciptakan lingkungan kerja yang produktif dan membangun keberlanjutan dalam jangka panjang.
          </p>
        </div>
      </div>
    </section>

    <section class="py-8">
      <div class="flex flex-col-reverse md:flex-row justify-between gap-10">
        <div class="flex flex-col">
          <h2 class="text-xl md:text-3xl text-primary font-bold mb-8">Tetap patuh terhadap Pajak Usaha Kamu</h2>
          <p class="text-base md:text-lg text-medium mb-6">
            Bayar pajak usaha itu penting banget!
            <br/><br/>
            Selain jaga nama baik bisnis dan hubungan baik sama pihak pajak, juga bisa hindarin masalah hukum dan denda yang bikin repot. Lebih dari itu, bayar pajak juga bikin bisnis kita tetap legal dan tidak terkena sanksi yang bikin rugi.
            <br/><br/>
            Jadi, jangan lupa bayar pajak, ya! Kita juga bisa jadi bagian penting dalam membangun kepercayaan, stabilitas, dan pertumbuhan bisnis yang lancar dan sukses.
          </p>
        </div>
          <div class="splide w-96 md:w-4/12" id="pajakSection">
          <div class="mb-10 md:px-16">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($pajak as $key => $pjk)
                <li class="splide__slide relative">
                  <a href="{{ $pjk->site }}" class="flex flex-col my-10">
                  <div class="w-full flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                    <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center" src="{{ $pjk->image }}" />
                  </div>
                  <p class="font-semibold text-xl text-center">{{ $pjk->name }}</p>
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
      <div class="flex flex-col md:flex-row justify-between gap-10">
        <div class="splide w-96 md:w-4/12" id="pemasaranSection">
          <div class="mb-10 md:px-16">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($pemasaran as $key => $pasar)
                <li class="splide__slide relative">
                  <a href="{{ $pasar->site }}" class="flex flex-col my-10">
                  <div class="w-full flex justify-center items-center max-xl:mt-0 mt-16 mb-4">
                    <img class="h-28 w-28 md:w-auto object-contain flex items-center justify-center" src="{{ $pasar->image }}" />
                  </div>
                  <p class="font-semibold text-xl text-center">{{ $pasar->name }}</p>
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
            Pemasaran sangat penting untuk bisnis kita. Meskipun produk atau jasa yang kita tawarkan hebat, tanpa pemasaran yang tepat, kita tidak akan mendapatkan pelanggan. Pemasaran membantu kita menampilkan bisnis kita ke dunia luar, menarik perhatian target pasar, dan membangun hubungan yang kuat dengan pelanggan. Pemasaran yang baik dapat membantu kita mengembangkan merek kita, meningkatkan penjualan, dan membuat bisnis kita sukses. Oleh karena itu, jangan meremehkan pentingnya pemasaran untuk membuat bisnis kita sukses besar.
          </p>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
  // init splide on hero section

  new Splide("#finance-section", {
    arrows: false,
    autoplay: false,
    pagination: false,
    perMove: 1,
    // type: 'loop',
    gap: '2rem',
    perPage: 1
  }).mount();

  new Splide("#sumberdayaSection", {
    autoplay: true,
    pagination: false,
    perMove: 1,
    type: 'loop',
    gap: '2rem',
    perPage: 1
  }).mount();

  new Splide("#pajakSection", {
    arrows: false,
    autoplay: false,
    pagination: false,
    perMove: 1,
    // type: 'loop',
    gap: '2rem',
    perPage: 1
  }).mount();

  new Splide("#pemasaranSection", {
    autoplay: true,
    pagination: false,
    perMove: 1,
    type: 'loop',
    gap: '2rem',
    perPage: 1
  }).mount();
  </script>
@endsection
