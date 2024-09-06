<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - EnterpreneurHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="flex flex-col items-center font-poppins">
        <div
            class=" max-xl:bg-white  gap-6 rounded-3xl max-xl:mx-[5px] mx-[43px] max-xl:my-[10px] my-[68px] bg-[#8AAF4A] max-xl:mr-0 mr-80 w-full md:w-8/12">
            <div class=" flex m-[57px] max-xl:m-[10px] flex-row rounded-3xl ">
                <div class="max-xl:hidden  flex flex-col justify-center w-10/12 rounded-l-3xl p-16 ">
                    <h1 class="max-xl:hidden text-white mb-[49px] text-center font-semibold">Gabung dan Temukan
                        Manfaatnya</h1>
                    <div
                        class="bg-opacity-20 rounded-3xl bg-white px-[32px] py-[40px] items-center justify-center flex flex-col">
                        <p class="text-white text-center text-base font-medium">
                            “Senang sekali menjadi 100 wirausaha yang terpilih. Pada acara EntrepreneurHub ini, saya
                            banyak mendapatkan insight penting untuk bisnis saya. Dengan bimbingan Mentor Darwadi,
                            mudah-mudahan bisnis catering dan dessert saya bisa bertumbuh pesat.”
                        </p>
                        <img class="w-14 h-14 object-cover mt-10 rounded-full"
                            src="{{ asset('images/testimoni/testimoni2.jpg') }}" alt="pelaku-usaha" />
                        <p class="text-white my-1 text-center text-md font-semibold">Widya Natalia</p>
                        <p class="text-white text-center text-sm font-light">Owner @sweetiws dan @jineng.catering</p>
                    </div>
                </div>

                <div
                    class="flex flex-col max-xl:border-0 shadow-3xl border border-gray-200 max-xl:w-screen max-xl:-mr-0 -mr-80 bg-white rounded-3xl max-xl:p-[10px] p-[40px] gap-6 w-full">
                    <div>
                        <img class="w-auto h-[56px] object-contain" src="{{ asset('images/logo-ehub-new.png') }}"
                            alt="pelaku-usaha" />
                    </div>
                    <h2 class="text-5xl font-semibold text-primary">Daftar</h2>
                    <p class="text-base font-medium text-primary"> Silakan registrasi untuk membuat akun</p>
                    <form id="register" action="{{ route('register') }}" method="POST"
                        class="grid grid-cols-1 gap-y-4">
                        @csrf
                        <div class="flex flex-col">
                            <label class="text-sm font-semibold text-gray-500 mb-1">Nama <span class="text-secondary">*</span></label>
                            <input id="fullname" class="border {{ $errors->has('fullname') ? 'border-red-500' : 'border-gray-200' }} rounded-xl w-full py-3 px-4 text-gray-800 leading-tight focus:ring-primary" name="fullname" value="{{ old('fullname') }}" type="text" placeholder="Nama Lengkap" />
                            @error('fullname')
                                <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm font-semibold text-gray-500 mb-1">Email <span class="text-secondary">*</span></label>
                            <input id="email" class="border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-xl w-full py-3 px-4 text-gray-800 leading-tight focus:ring-primary" name="email" type="email" value="{{ old('email') }}" placeholder="Email" />
                            @error('email')
                                <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm font-semibold text-gray-500 mb-1">Nomor Whatsapp <span
                                    class="text-secondary">*</span></label>
                            <input
                                class="border {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-200' }} rounded-xl w-full py-3 px-4 text-gray-800 leading-tight focus:ring-primary"
                                id="phone" name="phone" type="number" value="{{ old('phone') }}"
                                placeholder="62xxxxxx">
                            @error('phone')
                                <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm font-semibold text-gray-500 mb-1">Password <span
                                    class="text-secondary">*</span></label>
                            <div class="relative w-full" x-data="{ show: true }" x-cloak>
                                <input
                                    class="border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl w-full py-3 pl-4 pr-16 text-gray-800 leading-tight focus:ring-primarye"
                                    id="Password" name="password" :type="show ? 'password' : 'text'"
                                    placeholder="*******">
                                <button type="button"
                                    class="flex absolute top-0 right-0 mr-4 my-3 focus:outline-none text-lg text-gray-600 cursor-pointer"
                                    :class="{ 'hidden': !show, 'block': show }" @click="show = !show">
                                    <svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 12C11.1046 12 12 11.1046 12 10C12 8.89543 11.1046 8 10 8C8.89544 8 8.00001 8.89543 8.00001 10C8.00001 11.1046 8.89544 12 10 12Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.457764 10C1.73202 5.94291 5.52232 3 9.99997 3C14.4776 3 18.2679 5.94288 19.5422 9.99996C18.2679 14.0571 14.4776 17 9.99995 17C5.52232 17 1.73204 14.0571 0.457764 10ZM14 10C14 12.2091 12.2091 14 10 14C7.79087 14 6.00001 12.2091 6.00001 10C6.00001 7.79086 7.79087 6 10 6C12.2091 6 14 7.79086 14 10Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="flex absolute top-0 right-0 mr-4 my-3 focus:outline-none text-lg text-gray-600 cursor-pointer"
                                    :class="{ 'block': !show, 'hidden': show }" @click="show = !show">
                                    <svg width="22" height="20" viewBox="0 0 20 20" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.70711 2.29289C3.31658 1.90237 2.68342 1.90237 2.29289 2.29289C1.90237 2.68342 1.90237 3.31658 2.29289 3.70711L16.2929 17.7071C16.6834 18.0976 17.3166 18.0976 17.7071 17.7071C18.0976 17.3166 18.0976 16.6834 17.7071 16.2929L16.2339 14.8197C17.7715 13.5924 18.939 11.9211 19.5424 9.99996C18.2681 5.94288 14.4778 3 10.0002 3C8.37665 3 6.84344 3.38692 5.48779 4.07358L3.70711 2.29289ZM7.96813 6.55391L9.48201 8.0678C9.6473 8.02358 9.82102 8 10.0003 8C11.1048 8 12.0003 8.89543 12.0003 10C12.0003 10.1792 11.9767 10.353 11.9325 10.5182L13.4463 12.0321C13.7983 11.4366 14.0003 10.7419 14.0003 10C14.0003 7.79086 12.2094 6 10.0003 6C9.25838 6 8.56367 6.20197 7.96813 6.55391Z"
                                            fill="currentColor" />
                                        <path
                                            d="M12.4541 16.6967L9.74965 13.9923C7.74013 13.8681 6.1322 12.2601 6.00798 10.2506L2.33492 6.57754C1.50063 7.57223 0.856368 8.73169 0.458008 10C1.73228 14.0571 5.52257 17 10.0002 17C10.8469 17 11.6689 16.8948 12.4541 16.6967Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-8">
                            <label class="text-sm font-semibold text-gray-500 mb-1">Ketik Ulang Password <span
                                    class="text-secondary">*</span></label>
                            <div class="relative w-full" x-data="{ show: true }" x-cloak>
                                <input
                                    class="border {{ $errors->has('confirm_password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl w-full py-3 pl-4 pr-16 text-gray-800 leading-tight focus:ring-primary"
                                    id="confirm_password" name="confirm_password" :type="show ? 'password' : 'text'"
                                    placeholder="********">
                                <button type="button"
                                    class="flex absolute top-0 right-0 mr-4 my-3 focus:outline-none text-lg text-gray-600 cursor-pointer"
                                    :class="{ 'hidden': !show, 'block': show }" @click="show = !show">
                                    <svg width="22" height="22" viewBox="0 0 20 20" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 12C11.1046 12 12 11.1046 12 10C12 8.89543 11.1046 8 10 8C8.89544 8 8.00001 8.89543 8.00001 10C8.00001 11.1046 8.89544 12 10 12Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.457764 10C1.73202 5.94291 5.52232 3 9.99997 3C14.4776 3 18.2679 5.94288 19.5422 9.99996C18.2679 14.0571 14.4776 17 9.99995 17C5.52232 17 1.73204 14.0571 0.457764 10ZM14 10C14 12.2091 12.2091 14 10 14C7.79087 14 6.00001 12.2091 6.00001 10C6.00001 7.79086 7.79087 6 10 6C12.2091 6 14 7.79086 14 10Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="flex absolute top-0 right-0 mr-4 my-3 focus:outline-none text-lg text-gray-600 cursor-pointer"
                                    :class="{ 'block': !show, 'hidden': show }" @click="show = !show">
                                    <svg width="22" height="20" viewBox="0 0 20 20" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.70711 2.29289C3.31658 1.90237 2.68342 1.90237 2.29289 2.29289C1.90237 2.68342 1.90237 3.31658 2.29289 3.70711L16.2929 17.7071C16.6834 18.0976 17.3166 18.0976 17.7071 17.7071C18.0976 17.3166 18.0976 16.6834 17.7071 16.2929L16.2339 14.8197C17.7715 13.5924 18.939 11.9211 19.5424 9.99996C18.2681 5.94288 14.4778 3 10.0002 3C8.37665 3 6.84344 3.38692 5.48779 4.07358L3.70711 2.29289ZM7.96813 6.55391L9.48201 8.0678C9.6473 8.02358 9.82102 8 10.0003 8C11.1048 8 12.0003 8.89543 12.0003 10C12.0003 10.1792 11.9767 10.353 11.9325 10.5182L13.4463 12.0321C13.7983 11.4366 14.0003 10.7419 14.0003 10C14.0003 7.79086 12.2094 6 10.0003 6C9.25838 6 8.56367 6.20197 7.96813 6.55391Z"
                                            fill="currentColor" />
                                        <path
                                            d="M12.4541 16.6967L9.74965 13.9923C7.74013 13.8681 6.1322 12.2601 6.00798 10.2506L2.33492 6.57754C1.50063 7.57223 0.856368 8.73169 0.458008 10C1.73228 14.0571 5.52257 17 10.0002 17C10.8469 17 11.6689 16.8948 12.4541 16.6967Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            @error('confirm_password')
                                <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" id="btn-register" class="inline-flex justify-center items-center btn btn-lg btn-secondary">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Daftar
                        </button>
                        <div class="text-base font-medium text-primary text-center ">
                            Sudah mempunyai akun ? silakan <a href="{{ route('login') }}"
                                class="cursor-pointer inline font-bold"> Login </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- AlphineJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3'])
    <script async id="googleTag"></script>
    <script>
        const GTAG_CONFIG = "{{ config('app.gtag_config') }}";
        const URL_GTAG = 'https://www.googletagmanager.com/gtag/js?id='+GTAG_CONFIG;
        document.getElementById('googleTag').src = URL_GTAG;


        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', GTAG_CONFIG);

        // form register submitted
        const form = document.getElementById('register');
        const btnRegister = document.getElementById('btn-register');
        const spinner = btnRegister.childNodes[1];
        form.addEventListener('submit', function(e){
            e.preventDefault(); 

            btnRegister.disabled = true;
            spinner.classList.remove('hidden');

            form.submit();
        });
    </script>
</body>

</html>
