<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('extra-title') - EnterpreneurHub</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('extra-css')
</head>
<body>
  <div class="flex flex-col items-center">
    <div class="max-[360px]:max-w-[240px] tablet-air:max-w-[744px] tablet-mini:max-w-[744px]
    tablet-pro7:max-w-[888px] tablet-duo:max-w-[516px] tablet-fold:max-w-[256px]
    tablet-a51:max-w-[336px] tablet-nest:max-w-[386px] tablet-nest-max:max-w-[456px]
    sm:max-w-[640px] lg:max-w-[1024px]
    xl:max-w-full 2xl:max-w-full 3xl:max-w-[1792px]">
      <div class="px-6 md:px-[76px]">
        @if(!request()->is('profile/edit'))
          <header>
            @include('landing.layouts.navbar')
          </header>
        @endif

        <main class="content">
          <section>
            @yield('page-title')
          </section>

          @yield('content')
        </main>

        <footer>
          @include('landing.layouts.footer')
        </footer>
      </div>
    </div>

    <!-- Global Modal -->
    <div class="modal fixed w-full h-full top-0 left-0 z-20 hidden  items-center justify-center" id="modalConsultation">
      <div class="overlay absolute w-full h-full bg-gray-900 opacity-80"></div>
      <div class="bg-white w-full mx-2 sm:w-10/12 sm:mx-0 -mt-12 md:mt-0 md:w-8/12 lg:w-6/12 xl:w-4/12 rounded-2xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content flex items-center text-left">
          <div class="flex flex-col w-full justify-center">
            <div class="flex w-full items-center justify-center p-6 border-b border-gray-300">
                <h5 class="font-semibold capitalize text-center w-full">Ajukan pertanyaan</h5>
                <button type="button" class="rounded-md hover:shadow-md transition-all close-modal flex justify-end">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292787 1.29259C0.480314 1.10512 0.734622 0.999806 0.999786 0.999806C1.26495 0.999806 1.51926 1.10512 1.70679 1.29259L5.99979 5.58559L10.2928 1.29259C10.385 1.19708 10.4954 1.1209 10.6174 1.06849C10.7394 1.01608 10.8706 0.988496 11.0034 0.987342C11.1362 0.986189 11.2678 1.01149 11.3907 1.06177C11.5136 1.11205 11.6253 1.18631 11.7192 1.2802C11.8131 1.37409 11.8873 1.48574 11.9376 1.60864C11.9879 1.73154 12.0132 1.86321 12.012 1.99599C12.0109 2.12877 11.9833 2.25999 11.9309 2.382C11.8785 2.504 11.8023 2.61435 11.7068 2.70659L7.41379 6.99959L11.7068 11.2926C11.8889 11.4812 11.9897 11.7338 11.9875 11.996C11.9852 12.2582 11.88 12.509 11.6946 12.6944C11.5092 12.8798 11.2584 12.985 10.9962 12.9873C10.734 12.9895 10.4814 12.8888 10.2928 12.7066L5.99979 8.41359L1.70679 12.7066C1.51818 12.8888 1.26558 12.9895 1.00339 12.9873C0.741188 12.985 0.490376 12.8798 0.304968 12.6944C0.11956 12.509 0.0143906 12.2582 0.0121121 11.996C0.00983372 11.7338 0.110629 11.4812 0.292787 11.2926L4.58579 6.99959L0.292787 2.70659C0.105316 2.51907 0 2.26476 0 1.99959C0 1.73443 0.105316 1.48012 0.292787 1.29259Z" fill="#1F2937"/>
                    </svg>
                </button>
            </div>
            <form method="POST" class="w-full p-8" action="{{ route('mentor.consultation.store') }}">
              @csrf
              <input type="hidden" name="mentor_id" class="consultation-mentor-id" value="" />
              <div class="border border-gray-200 rounded p-4 mb-6">
                  <div class="flex flex-row items-center">
                      <img class="rounded-full h-12 w-12 object-cover mr-4 consultation-mentor-photo" src="{{ asset('images/logos/8-biffco.png') }}">
                      <div class="flex flex-col justify-between">
                          <p class="font-bold text-lg text-gray-800 consultation-mentor-fullname"></p>
                          <p class="text-base text-gray-500 consultation-mentor-expertise"></p>
                      </div>
                  </div>
              </div>
              <div class="flex flex-col mb-6">
                  <label class="text-gray-600 text-sm font-semibold mb-1">Subject</label>
                  <input type="text" name="subject" class="p-3 rounded placeholder-gray-200 bg-white text-gray-800 border border-gray-200" placeholder="Subject" required>
              </div>
              <div class="flex flex-col mb-6">
                  <label class="text-gray-600 text-sm font-semibold mb-1">Pertanyaan</label>
                  <textarea rows="4" name="question" class="p-3 rounded placeholder-gray-200 text-gray-800 border border-gray-200" placeholder="Tulis Disini"></textarea>
              </div>
              <button type="submit" id="submit-button" class="flex w-full justify-center p-3 text-center bg-secondary text-white rounded-2xl font-bold">Kirim Pertanyaan</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fixed w-full h-full top-0 left-0 z-20 hidden items-center justify-center" id="modal-display-image">
      <div class="overlay absolute w-full h-full bg-gray-900 opacity-80"></div>
      <div class="bg-white w-4/12 rounded-2xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content flex items-center text-left">
          <div class="flex flex-col w-full justify-center">
            <div class="w-full">
              <img id="image-preview" />
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
  <script>
    // handle burger menu in mobile view
    function onToggleMenu(e) {
      const navLinks = document.querySelector('.nav-links');
      e.name = e.name === 'menu' ? 'close' : 'menu';
      navLinks.classList.toggle('top-[10%]');
    }
  </script>
  <script async id="googleTag"></script>
  <script>
    const GTAG_CONFIG = "{{ config('app.gtag_config') }}";
    const URL_GTAG = 'https://www.googletagmanager.com/gtag/js?id='+GTAG_CONFIG;
    document.getElementById('googleTag').src = URL_GTAG;
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', GTAG_CONFIG);
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const submitButton = document.getElementById('submit-button');
      const modalConsultation = document.getElementById('modalConsultation');
      const closeConsultationModal = document.querySelector('#modalConsultation .close-modal');

      submitButton.addEventListener('click', function () {
        modalConsultation.classList.add('hidden'); // Menyembunyikan modal
      });
    });
  </script>
  @yield('extra-js')
</body>
</html>
