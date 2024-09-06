@extends('landing.layouts.app')
@section('extra-title') Lengkapi Profil @endsection

@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.css" />
    <style>
        .tabcontent {
            display: none;
        }

        .ss-main {
            padding: 10px 12px;
            ;
        }

        .ss-main .ss-values .ss-value {
            padding: 8px;
        }

        .ss-main .ss-values .ss-value .ss-value-text {
            font-size: 16px;
            line-height: 1;
        }

        .ss-main .ss-values .ss-value .ss-value-delete {
            height: 16px;
            width: 12px;
        }

        .ss-main .ss-values .ss-value .ss-value-delete svg {
            height: 12px;
            width: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="flex">
        <div class="w-4/12 hidden xl:flex flex-grow bg-[#F8FAFC] pr-12 -ml-[76px]">
            <div class="py-10 px-[76px]">
                <div class="flex items-center gap-2 mb-5">
                    <img class="w-32" src="{{ asset('images/logo-kemenkop-v2.png') }}" alt="Logo Kemenkop" />
                    <img class="w-32" src="{{ asset('images/logo-ehub-v2.png') }}" alt="Logo EnterpreneurHub" />
                </div>
                <p class="text-lg text-gray-600">Lengkapi data anda untuk bisa mengikuti program-program dari
                    EntrepreneurHub Gratis!</p>
                <div class="flex flex-col py-16 gap-7">
                    <a type="button" onclick="activateTab(event, 'form-step-1')"
                        class="flex flex-row gap-3 cursor-pointer">
                        <ion-icon name="checkmark-circle-outline"
                            class="tab-sign text-[#16A34A] text-3xl font-bold"></ion-icon>
                        <div class="flex flex-col">
                            <div class="font-bold text-gray-800">Data Diri</div>
                            <span class="text-gray-500">Lengkapi data diri anda</span>
                        </div>
                    </a>
                    <a type="button" onclick="activateTab(event, 'form-step-2')"
                        class="flex flex-row gap-3 cursor-pointer">
                        <ion-icon name="checkmark-circle-outline"
                            class="tab-sign text-[#4B5563] text-3xl font-bold"></ion-icon>
                        <div class="flex flex-col">
                            <div class="font-bold text-gray-800">Data Usaha</div>
                            <span class="text-gray-500">Lengkapi data usaha anda</span>
                        </div>
                    </a>
                    <a type="button" onclick="activateTab(event, 'form-step-3')"
                        class="flex flex-row gap-3 cursor-pointer">
                        <ion-icon name="checkmark-circle-outline"
                            class="tab-sign text-[#4B5563] text-3xl font-bold"></ion-icon>
                        <div class="flex flex-col">
                            <div class="font-bold text-gray-800">Data Marketing</div>
                            <span class="text-gray-500">Lengkapi data marketing anda</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-6/12 flex-grow">
            <div class="flex justify-center py-10">
                <div class="flex flex-col w-full px-5 lg:px-40">
                    <div class="flex flex-col mb-6">
                        <div id="form-title" class="font-bold text-gray-800">Data Diri</div>
                        <span id="form-subtitle" class="text-gray-500">Lengkapi data diri anda</span>
                    </div>
                    <form id="form-update-data" action="{{ route('profile.store') }}" method="POST">
                        @csrf
                        <div class="hidden">
                            <input type="hidden" name="next_name" value="{{ request()->input('next_name') }}" />
                            <input type="hidden" name="next_value" value="{{ request()->input('next_value') }}" />
                        </div>
                        <section id="form-step-1" class="tabcontent" style="display: block;">
                            <div class="mb-5">
                                <div class="flex flex-row items-center gap-1 mb-2">
                                    <label class="block text-[#4B5563] text-xs font-semibold" id="label-fullname"
                                        for="fullname">Nama</label>
                                    <span class="text-secondary">*</span>
                                </div>
                                <input id="fullname"
                                    class="appearance-none read-only:bg-gray-200 border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="fullname" type="text" placeholder="Masukkan nama" value="{{ $user->fullname }}"
                                    readonly />
                                <span id="error-fullname" class="text-red-500 text-sm mt-1"></span>
                            </div>
                            <div class="mb-5">
                                <div class="flex flex-row items-center gap-1 mb-2">
                                    <label class="block text-[#4B5563] text-xs font-semibold" id="label-email"
                                        for="email">Email</label>
                                    <span class="text-secondary">*</span>
                                </div>
                                <input id="email"
                                    class="appearance-none read-only:bg-gray-200 border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="email" type="email" placeholder="contoh: budi@gmail.com"
                                    value="{{ $user->email }}" readonly />
                                <span id="error-email" class="text-red-500 text-sm mt-1"></span>
                            </div>
                            <div class="mb-5">
                                <div class="flex flex-row items-center gap-1 mb-2">
                                    <label class="block text-[#4B5563] text-xs font-semibold" id="label-phone-number"
                                        for="phone-number">No. HP/WhatsApp</label>
                                    <span class="text-secondary">*</span>
                                </div>
                                <input id="phone-number"
                                    class="appearance-none read-only:bg-gray-200 border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="phone" type="text" placeholder="contoh: 08151563xxxx"
                                    value="{{ $user->phone }}" readonly />
                                <span id="error-phone-number" class="text-red-500 text-sm mt-1"></span>
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-date">Tanggal
                                    Lahir</label>
                                <div class="relative">
                                    <input id="born-date"
                                        class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                        name="born_date" type="text" placeholder="26 April 1990" />
                                    <ion-icon name="calendar-clear-outline"
                                        class="absolute right-3 top-2.5 text-xl"></ion-icon>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="born-place">Tempat
                                    Lahir</label>
                                <input id="born-place"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="born_place" type="text" placeholder="contoh: Jakarta" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="gender">Jenis
                                    Kelamin</label>
                                <div class="flex flex-row gap-4 ml-2">
                                    <div class="flex items-center mb-4">
                                        <input id="country-option-1" type="radio" name="gender" value="male"
                                            class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            aria-labelledby="country-option-1" aria-describedby="country-option-1"
                                            checked />
                                        <label for="country-option-1"
                                            class="text-[#4C4E64DE] ml-2 block">Laki-Laki</label>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="country-option-2" type="radio" name="gender" value="female"
                                            class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            aria-labelledby="country-option-2" aria-describedby="country-option-2" />
                                        <label for="country-option-2"
                                            class="text-[#4C4E64DE] ml-2 block">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-block btn-lg btn-secondary mt-16"
                                onclick="activateTab(event, 'form-step-2')">Berikutnya</button>
                        </section>
                        <section id="form-step-2" class="tabcontent">
                            <div class="mb-5">
                                <div class="flex flex-row items-center gap-1 mb-2">
                                    <label class="block text-[#4B5563] text-xs font-semibold" for="business-name">Nama Ide
                                        Usaha atau Nama Usaha</label>
                                </div>
                                <input id="business-name"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="business_name" type="text" placeholder="Nama usaha" />
                            </div>
                            <div class="mb-5 grid grid-cols-1 lg:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[#4B5563] text-xs font-semibold mb-2"
                                        for="state">Provinsi</label>
                                    <div class="relative">
                                        <select id="state" class="block form-input appearance-none w-full"
                                            name="state">
                                            <option data-placeholder="true"></option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->state_code }}">{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[#4B5563] text-xs font-semibold mb-2"
                                        for="city">Kabupaten/Kota</label>
                                    <div class="relative">
                                        <select id="city" class="block form-input appearance-none w-full"
                                            name="city">
                                            <option data-placeholder="true"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 grid grid-cols-1 lg:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[#4B5563] text-xs font-semibold mb-2"
                                        for="sector">Kecamatan</label>
                                    <div class="relative">
                                        <select id="sector" class="block form-input appearance-none w-full"
                                            name="sector">
                                            <option data-placeholder="true"></option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[#4B5563] text-xs font-semibold mb-2"
                                        for="village">Kelurahan</label>
                                    <div class="relative">
                                        <select id="village" class="block form-input appearance-none w-full"
                                            name="village">
                                            <option data-placeholder="true"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="flex flex-row items-center gap-1 mb-2">
                                    <label class="block text-[#4B5563] text-xs font-semibold"
                                        for="business-address">Alamat Usaha</label>
                                </div>
                                <textarea id="business-address" class="resize text-sm p-2 w-full border border-[#E5E7EB] rounded-md" rows="5"
                                    name="business_address" placeholder="Masukkan alamat usaha"></textarea>
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="business-type">Jenis
                                    Usaha</label>
                                <div class="relative">
                                    <select id="business-type"
                                        class="block appearance-none w-full border border-[#E5E7EB] text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none"
                                        name="business_type">
                                        <option value="">:: Pilih jenis usaha</option>
                                        @foreach ($business_types as $business_type)
                                            <option value="{{ $business_type->id }}">{{ $business_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="nib_number">Nomor
                                    NIB</label>
                                <input id="nib_number"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="nib_number" type="text" placeholder="JDK000231xxxx" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="nib-created-at">Tahun
                                    Pembuatan NIB
                                </label>

                                <div class="mb-5">
                                    <select id="nib-created-at"
                                        class="block appearance-none w-full border border-[#E5E7EB] text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none"
                                        name="nib_created_at">
                                        <option data-placeholder="true" id="nib-created-at" selected disabled>:: Pilih Tahun Pembuatan NIB</option>
                                        @php
                                            $currentYear = \Carbon\Carbon::now()->year;
                                        @endphp

                                        @for ($year = $currentYear; $year >= 2005; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>


                            </div>
                            <div class="flex flex-row gap-x-5 mt-16">
                                <button type="button" class="btn btn-block btn-lg btn-outline-secondary"
                                    onclick="activateTab(event, 'form-step-1')">Sebelumnya</button>
                                <button type="button" class="btn btn-block btn-lg btn-secondary"
                                    onclick="activateTab(event, 'form-step-3')">Berikutnya</button>
                            </div>
                        </section>
                        <section id="form-step-3" class="tabcontent">
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="ig-account">Akun IG
                                    Usaha</label>
                                <input id="ig-account"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="ig_account" type="text" placeholder="Akun Instagram" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="fb-account">Akun FB
                                    Usaha</label>
                                <input id="fb-account"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="fb_account" type="text" placeholder="Akun Facebook" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="tiktok-account">Akun
                                    TikTok Usaha</label>
                                <input id="tiktok-account"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="tiktok_account" type="text" placeholder="Akun Tiktok" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="business-site">Situs
                                    Usaha</label>
                                <input id="business-site"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="business_site" type="text" placeholder="Nama Website (usahaku.com)" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="community">Komunitas
                                    Usaha</label>
                                <input id="community"
                                    class="appearance-none border border-[#E5E7EB] w-full py-2 px-3 text-gray-700 placeholder:text-[#6B7280] focus:outline-none"
                                    name="community" type="text" placeholder="Nama Komunitas Usaha" />
                            </div>
                            <div class="mb-5">
                                <label class="block text-[#4B5563] text-xs font-semibold mb-2" for="gender">Platform
                                    Usaha</label>
                                <div class="flex flex-col gap-4 ml-2">
                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="shopee"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="shopee" />
                                        <label for="shopee" class="ml-4 text-[#374151] cursor-pointer">Shopee</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="tokopedia"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="tokopedia" />
                                        <label for="tokopedia" class="ml-4 text-[#374151] cursor-pointer">Tokopedia</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="blibli"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="blibli" />
                                        <label for="blibli" class="ml-4 text-[#374151] cursor-pointer">Blibli</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="lazada"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="lazada" />
                                        <label for="lazada" class="ml-4 text-[#374151] cursor-pointer">Lazada</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="bukalapak"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="bukalapak" />
                                        <label for="bukalapak" class="ml-4 text-[#374151] cursor-pointer">Bukalapak</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="grab"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="grab" />
                                        <label for="grab" class="ml-4 text-[#374151] cursor-pointer">Grab</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="gojek"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="gojek" />
                                        <label for="gojek" class="ml-4 text-[#374151] cursor-pointer">Gojek</label>
                                    </div>

                                    <div class="flex flex-row items-center">
                                        <input type="checkbox" id="lainnya"
                                            class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer"
                                            name="business_platform[]" value="Lainnya" />
                                        <label for="lainnya" class="ml-4 text-[#374151] cursor-pointer">Lainnya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-5 mt-16">
                                <button type="button" class="btn btn-block btn-lg btn-outline-secondary"
                                    onclick="activateTab(event, 'form-step-2')">Sebelumnya</button>
                                <button type="submit"  id="submitButton" class="btn btn-block btn-lg btn-secondary">Kirim</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.js"></script>
    <script>
        const submitButton = document.getElementById('submitButton');
        const form = document.querySelector('form');

        form.addEventListener('submit', (e) => {
            
            submitButton.disabled = true;
        });

        function toTitleCase(str) {
            return str.replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }

        flatpickr("#born-date", {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d"
        });

        function activateTab(evt, formStep) {
            var i, tabcontent, tablinks;
            var validation = inputValidation(formStep);
            if (validation) {
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(formStep).style.display = "block";
                evt.currentTarget.className += " active";

                toggleTabSign(formStep);
            } else {
                return false;
            }
        }

        function toggleTabSign(activeTab) {
            const formTitle = document.getElementById("form-title");
            const formSubtitle = document.getElementById("form-subtitle");
            const tabSign = document.getElementsByClassName("tab-sign");
            const currentTab = +activeTab.slice(-1) - 1;

            if (currentTab === 0) {
                formTitle.innerHTML = 'Data Diri';
                formSubtitle.innerHTML = 'Lengkapi data diri anda';
            } else if (currentTab === 1) {
                formTitle.innerHTML = 'Data Usaha';
                formSubtitle.innerHTML = 'Lengkapi data usaha anda';
            } else if (currentTab === 2) {
                formTitle.innerHTML = 'Data Marketing';
                formSubtitle.innerHTML = 'Lengkapi data marketing anda';
            }
            for (let i = 1; i <= 3; i++) {
                var formStepElement = document.getElementById('form-step-' + i);
                var inputs = formStepElement.querySelectorAll('input, textarea, select');
                var flag = true;
                for (let j = 0; j < inputs.length; j++) {
                    if (inputs[j].value == '') {
                        flag = false;
                    }
                }
                if ((i - 1) == currentTab) {
                    tabSign[currentTab].classList.remove("text-[#4B5563]");
                    tabSign[currentTab].classList.remove("text-[#16A34A]/[0.5]");
                    tabSign[currentTab].classList.add("text-[#16A34A]");
                } else {
                    if (flag) {
                        tabSign[(i - 1)].classList.remove("text-[#4B5563]");
                        tabSign[(i - 1)].classList.remove("text-[#16A34A]");
                        tabSign[(i - 1)].classList.add("text-[#16A34A]/[0.5]");
                    } else {
                        tabSign[(i - 1)].classList.remove("text-[#16A34A]");
                        tabSign[(i - 1)].classList.remove("text-[#16A34A]/[0.5]");
                        tabSign[(i - 1)].classList.add("text-[#4B5563]");
                    }
                }
            }
        }

        function inputValidation(formStep) {
            var currentTab = +formStep.slice(-1) - 1;
            var flag = true;
            if (currentTab == 1) {
                var fields = ['fullname', 'email', 'phone-number'];
                for (let i = 0; i < fields.length; i++) {
                    let elInput = document.getElementById(fields[i]);
                    let elLabel = document.getElementById('label-' + fields[i]);
                    let elError = document.getElementById('error-' + fields[i]);
                    elInput.classList.remove('border-red-500');
                    elInput.classList.add('border-[#E5E7EB]');
                    elError.innerHTML = '';
                    if (elInput.value == '') {
                        flag = false;
                        elInput.classList.remove('border-[#E5E7EB]');
                        elInput.classList.add('border-red-500');
                        elError.innerHTML = elLabel.textContent + ' wajib diisi!';
                    }
                    if (elInput.id == 'email' && elInput.value != '') {
                        var atposition = elInput.value.indexOf("@");
                        var dotposition = elInput.value.lastIndexOf(".");
                        if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= elInput.value.length) {
                            flag = false;
                            elInput.classList.remove('border-[#E5E7EB]');
                            elInput.classList.add('border-red-500');
                            elError.innerHTML = elLabel.textContent + ' harus diisi dengan email yang valid!';
                        }
                    }
                    if (elInput.id == 'phone-number' && elInput.value != '') {
                        if (isNaN(elInput.value)) {
                            flag = false;
                            elInput.classList.remove('border-[#E5E7EB]');
                            elInput.classList.add('border-red-500');
                            elError.innerHTML = elLabel.textContent + ' harus diisi dengan nomor yang valid!';
                        }
                    }
                }
            }
            return flag;
        }


        const slimSelectState = new SlimSelect({
            select: '#state',
            settings: {
                placeholderText: 'Pilih Provinsi',
            },
            events: {
                afterChange: (stateValue) => {
                    let stateCode = stateValue[0].value;
                    if (stateCode) {
                        renderCities(stateCode);
                    }
                }
            }
        });

        const slimSelectCity = new SlimSelect({
            select: '#city',
            settings: {
                placeholderText: 'Pilih Kabupaten/Kota',
            },
            events: {
                afterChange: (cityValue) => {
                    let cityCode = cityValue[0].value;
                    if (cityCode) {
                        renderSectors(cityCode);
                    }
                }
            }
        });

        const slimSelectSector = new SlimSelect({
            select: '#sector',
            settings: {
                placeholderText: 'Pilih Kecamatan',
            },
            events: {
                afterChange: (sectorValue) => {
                    let sectorCode = sectorValue[0]?.value;
                    if (sectorCode) {
                        renderVillages(sectorCode);
                    }
                }
            }
        });

        const slimSelectVillage = new SlimSelect({
            select: '#village',
            settings: {
                placeholderText: 'Pilih Kelurahan',
            }
        });

        async function getCities(stateCode) {
            var base_url = window.location.origin;
            var url = base_url + '/api/cities/' + stateCode;
            try {
                let response = await fetch(url);
                return await response.json();
            } catch (error) {
                return false;
            }
        }

        async function renderCities(stateCode) {
            let responses = await getCities(stateCode);
            if (!responses) {
                Swal.fire({
                    title: 'Error',
                    text: 'Maaf, terjadi kesalahan, silahkan coba lagi!',
                    type: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    confirmButtonClass: "btn btn-primary py-3 px-6"
                });
            } else {
                if (responses.success) {
                    const cities = responses.data;
                    var assignCityOptions = [];
                    for (var i = 0; i < cities.length; i++) {
                        const citiesNameTitleCase = toTitleCase(cities[i].city_name);
                        assignCityOptions[i] = {
                            'text': citiesNameTitleCase,
                            'value': cities[i].city_code
                        };
                    }
                    slimSelectCity.setData(assignCityOptions);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Maaf, data gagal dimuat!',
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn btn-primary py-3 px-6"
                    });
                }
            }
        }

        async function getSectors(cityCode) {
            var base_url = window.location.origin;
            var url = base_url + '/api/sectors/' + cityCode;
            try {
                let response = await fetch(url);
                return await response.json();
            } catch (error) {
                return false;
            }
        }

        async function renderSectors(cityCode) {
            let responses = await getSectors(cityCode);
            if (!responses) {
                Swal.fire({
                    title: 'Error',
                    text: 'Maaf, terjadi kesalahan, silahkan coba lagi!',
                    type: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    confirmButtonClass: "btn btn-primary py-3 px-6"
                });
            } else {
                if (responses.success) {
                    const sectors = responses.data;
                    var assignSectorOptions = [];
                    for (var i = 0; i < sectors.length; i++) {
                        const sectorsNameTitleCase = toTitleCase(sectors[i].sector_name);
                        assignSectorOptions[i] = {
                            'text': sectorsNameTitleCase,
                            'value': sectors[i].sector_code
                        };
                    }
                    slimSelectSector.setData(assignSectorOptions);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Maaf, data gagal dimuat!',
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn btn-primary py-3 px-6"
                    });
                }
            }
        }

        async function getVillages(sectorCode) {
            var base_url = window.location.origin;
            var url = base_url + '/api/villages/' + sectorCode;
            try {
                let response = await fetch(url);
                return await response.json();
            } catch (error) {
                return false;
            }
        }



        async function renderVillages(sectorCode) {
            let responses = await getVillages(sectorCode);

            if (!responses) {
                Swal.fire({
                    title: 'Error',
                    text: 'Maaf, terjadi kesalahan, silahkan coba lagi!',
                    type: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    confirmButtonClass: "btn btn-primary py-3 px-6"
                });
            } else {
                if (responses.success) {
                    const villages = responses.data;
                    var assignVillageOptions = [];
                    for (var i = 0; i < villages.length; i++) {
                        const villageNameTitleCase = toTitleCase(villages[i].village_name);
                        assignVillageOptions[i] = {
                            'text': villageNameTitleCase,
                            'value': villages[i].village_code
                        };
                    }
                    slimSelectVillage.setData(assignVillageOptions);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Maaf, data gagal dimuat!',
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn btn-primary py-3 px-6"
                    });
                }
            }
        }
    </script>
@endsection
