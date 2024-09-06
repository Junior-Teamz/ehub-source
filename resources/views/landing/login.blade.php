<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - EnterpreneurHub</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <div class="flex flex-col items-center font-poppins">
    <div class="max-xl:bg-white  gap-6 rounded-3xl max-xl:mx-[5px] mx-[43px] max-xl:my-[10px] my-[68px] bg-[#8AAF4A] max-xl:mr-0 mr-80 w-full md:w-8/12">
      <div class="flex m-[57px] max-xl:m-[10px] flex-row rounded-3xl">
        <div class="max-xl:hidden  flex flex-col justify-center w-10/12 rounded-l-3xl p-16">
          <h1 class="max-xl:hidden text-white mb-[49px] text-center font-semibold">
            Gabung dan Temukan Manfaatnya
          </h1>
          <div class="bg-opacity-20 rounded-3xl bg-white px-[32px] py-[40px] items-center justify-center flex flex-col">
            <p class="text-white text-center text-base font-medium">
              “Senang sekali menjadi 100 wirausaha yang terpilih. Pada acara EntrepreneurHub ini, saya banyak mendapatkan insight penting untuk bisnis saya. Dengan bimbingan Mentor Darwadi, mudah-mudahan bisnis catering dan dessert saya bisa bertumbuh pesat.”
            </p> 
            <img class="w-14 h-14 object-cover rounded-full mt-6" src="{{ asset('images/testimoni/testimoni2.jpg') }}" alt="pelaku-usaha" />
            <p class="text-white my-[5px] text-center text-md font-semibold">Widya Natalia</p> 
            <p class="text-white text-center text-sm font-light">Owner @sweetiws dan @jineng.catering</p>
          </div>
        </div>
        
        <form action="{{ route('do.login') }}" method="POST" class="flex flex-col max-xl:border-0 shadow-3xl border border-gray-200 max-xl:w-screen max-xl:-mr-0 -mr-80 bg-white rounded-3xl max-xl:p-[10px] p-[40px] gap-6 w-full">
          @csrf
          <div>
            <img class="block w-auto h-[56px] object-contain" src="{{ asset('images/logo-ehub-new.png') }}" alt="pelaku-usaha" />
          </div>  
          <div class="text-5xl font-semibold text-primary">Login</div>
          <div class="text-base font-medium text-primary">Silahkan Log-in untuk melanjutkan</div>
          <div class="flex flex-row text-xs font-semibold text-gray-500">Email</div>
          <div class="flex flex-col gap-1">
            <input
              class="shadow appearance-none border rounded-xl w-full py-4 -mt-4 px-4 text-gray-800 leading-tight focus:outline-primary focus:shadow-outline"
              id="user"
              name="email"
              type="text"
              placeholder="Namakamu@email.com"
              value="{{ old('email') }}" required
            />
            @if($errors->has('email'))
              <span class="text-red-500">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="flex flex-row text-xs font-semibold text-gray-500">
            <div>Password</div>
          </div>
          <input
            class="shadow appearance-none border rounded-xl w-full py-4 -mt-4 px-4 text-gray-800 leading-tight focus:outline-primary focus:shadow-outline"
            id="Password"
            name="password"
            type="password"
            placeholder="*******" required
          >
            <span class="-my-3 relative">
              <ion-icon color="medium" id="toggler1" class=" w-[22px] h-[15px] absolute right-3 bottom-8 cursor-pointer" name="eye-outline"></ion-icon>
            </span>
          @if($errors->has('password'))
            <span class="text-red-500 -mt-4">{{ $errors->first('password') }}</span>
          @endif

          @if ($errors->has('email_verify'))
            <div class="flex flex-col my-3">
              <span class="text-red-500 mb-1">{{ $errors->first('email_verify') }}</span>
              <span class="text-red-500">Silahkan klik link berikut ini untuk mengirimkan email verifikasi. <a id="verification-link" class="text-red-500 underline font-semibold" href="{{ route('email.send', [ 'email' => session('email')]) }}">Kirim Email Verifikasi</a></span>
            </div>
          @endif
          <div class="flex justify-end">
            <a href="{{ route('forgot.password') }}" class="hover:underline text-primary">Lupa kata sandi?</a>
          </div>
         
          <button type="submit" class="btn btn-secondary py-2">Login</button>
          <div class="text-base font-medium text-primary text-center">
            Belum punya akun, silahkan <a href="{{ route('register') }}" class="cursor-pointer inline font-bold"> Daftar Disini </a>
          </div>
        </form>

      </div>
    </div>
  </div>
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"></script>
  <script>
    const password = document.getElementById('Password');
    const toggler1 = document.getElementById('toggler1');

    showHidePassword1 = () => {
      if (password.type == 'password') {
        password.setAttribute('type', 'text');
        toggler1.setAttribute('name', 'eye-off-outline');
        toggler1.setAttribute('color', 'medium');
      } else {
        toggler1.setAttribute('name', 'eye-outline');
        password.setAttribute('type', 'password');
        toggler1.setAttribute('color', 'medium');
      }
    };
    toggler1.addEventListener('click', showHidePassword1);
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
  document.getElementById('verification-link').addEventListener('click', function (e) {

    const email = this.getAttribute('data-email');
    const verificationUrl = `{{ route('email.send', ['email' => ':email']) }}`.replace(':email', email);

    Swal.fire({
      title: 'Kirim Email Verifikasi',
      text: 'Mengirim Kode Verifikasi...',
      icon: 'info',
      showCancelButton: false,
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
    }).then((result) => {
      if (result.isConfirmed) {
        // SweetAlert has been acknowledged, you can proceed with sending the email.

        // Simulate the email sending process (change this to actual email sending).
        setTimeout(function () {
          // Once email sending is complete, navigate to the verification link.
          window.location.href = verificationUrl;
        }, 5000); // Simulate a 5-second delay for email sending
      }
      else {
        window.location.href = verificationUrl;
      }
    });
  });
</script>
</body>
</html>
