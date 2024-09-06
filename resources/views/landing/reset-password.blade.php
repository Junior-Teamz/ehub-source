<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - EnterpreneurHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="flex flex-col items-center font-poppins">
        <div class="bg-[#8AAF4A] w-full max-w-2xl mt-36">
            <div class="flex m-[57px] max-xl:m-[10px] flex-row rounded-3xl">
                <form action="{{ route('do.reset.password') }}" method="POST"
                    class="flex flex-col max-xl:border-0 shadow-3xl border border-gray-200 max-xl:w-screen max-xl:-mr-0 -mr-80 bg-white rounded-3xl max-xl:p-[10px] p-[40px] gap-6 w-full">
                    @csrf
                    <div>
                        <img class="block w-auto h-[56px] object-contain" src="{{ asset('images/logo-ehub-v2.png') }}"
                            alt="pelaku-usaha" />
                    </div>
                    <div class="text-2xl font-semibold text-primary">Reset Password</div>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="flex flex-row text-xs font-semibold text-gray-500">Kata Sandi Baru</div>
                    <div class="flex flex-col gap-1">
                        <input
                            class="shadow appearance-none border rounded-xl w-full py-4 -mt-4 px-4 text-gray-800 leading-tight focus:outline-primary focus:shadow-outline"
                            name="password" type="password" placeholder="******" />
                    </div>
                    <div class="flex flex-row text-xs font-semibold text-gray-500">Konfirmasi Sandi Baru</div>
                    <div class="flex flex-col gap-1">
                        <input
                            class="shadow appearance-none border rounded-xl w-full py-4 -mt-4 px-4 text-gray-800 leading-tight focus:outline-primary focus:shadow-outline"
                            name="password_confirmation" type="password" placeholder="******" />
                        @if (session('success'))
                            <span class="text-green-500">{{ session()->get('success') }}</span>
                        @endif
                        @error('password')
                            <span class="text-red-500">Mohon koreksi password terlebih dahulu!</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary py-2">Reset Password</button>
                    <div class="flex justify-center">
                        <a href="{{ route('login') }}"
                            class="text-base font-medium text-primary hover:underline">Kembali ke halaman login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
</body>

</html>
