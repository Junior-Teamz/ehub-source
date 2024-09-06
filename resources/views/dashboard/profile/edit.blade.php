@extends('dashboard.layouts.app')
@section('extra-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.css" integrity="sha512-GvqWM4KWH8mbgWIyvwdH8HgjUbyZTXrCq0sjGij9fDNiXz3vJoy3jCcAaWNekH2rJe4hXVWCJKN+bEW8V7AAEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" />
<style>
    .ss-main {
        padding: 10px 12px;
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
<div class="container">
    <div class="justify-center max-xl:w-full mb-8">
        <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
            <div class="flex justify-between">
                <span class="text-xl font-bold text-primary">Edit Profile</span>
            </div>
            <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="flex">
                <div class="flex flex-col mb-4 gap-2">
                    <div class="text-lg font-semibold text-primary mt-3 mb-1">Avatar</div>
                    <label for="avatar" class="text-xs block mb-1 mt-3">Foto Profil : (Max: 8MB, Dimensi: 800x800)</label>
                    <div id="image-preview-placeholder" class="h-[200px] w-[200px] rounded-2xl border-dashed border-2 border-primary bg-gray-300 cursor-pointer" onclick="document.getElementById('image-input').click()">
                       <img id="preview-image" class="w-[195px] h-[195px] object-cover rounded-2xl" src="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->avatar_url == NULL ? asset('images/news/placeholder.png') : $user->hasParticipant->avatar_url : asset('images/news/placeholder.png') }}" alt="Avatar Placeholder">
                    </div>
                    <input type="file" name="avatar" id="image-input" style="display: none;" onchange="previewImage(event)">
                    @error('avatar')
                        <span class="mt-1 text-red-500">Mohon mengunggah avatar / foto profile dengan kriteria yang telah ditentukan!</span>
                    @enderror
                </div>
                <div class="flex flex-grow"></div>
            </div>

            <div class="text-lg font-semibold text-primary my-3">Data Diri</div>
            <div class="flex md:flex-row flex-col w-full gap-6">
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="fullname">Nama Lengkap<span class="text-red-500">*</span></label>
                    <input id="fullname" name="fullname" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ $user->fullname }}"
                    class="w-full py-2.5 px-3 rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"/>
                    @error('fullname')
                        <span class="mt-1 text-red-500">Mohon menulis nama lengkap terlebih dahulu!</span>
                    @enderror
                    <label for="phone_number">Nomor Whatsapp<span class="text-red-500">*</span></label>
                    <input id="phone_number" name="phone_number" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ $user->phone }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"  >
                    @error('phone_number')
                        <span class="mt-1 text-red-500">Mohon menulis nomor whatsapp terlebih dahulu!</span>
                    @enderror
                    <label for="email">Email<span class="text-red-500">*</span></label>
                    <input id="email" name="email" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ $user->email }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"  >
                    @error('email')
                        <span class="mt-1 text-red-500">Mohon menulis email terlebih dahulu!</span>
                    @enderror
                </div>
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="born_place">Tempat Lahir</label>
                    <input id="born_place" name="born_place" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->born_place : NULL }}"  >
                    @error('born_place')
                        <span class="mt-1 text-red-500">Mohon menulis tempat lahir terlebih dahulu!</span>
                    @enderror
                    <label for="born_date">Tanggal Lahir</label>
                    <input id="born_date" name="born_date" type="date" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->born_date : NULL }}"  >
                    @error('born_date')
                        <span class="mt-1 text-red-500">Mohon menulis tanggal lahir terlebih dahulu!</span>
                    @enderror
                    <label class="mt-1" for="gender">Jenis Kelamin</label>
                    <div class="flex flex-row items-center gap-x-4 mt-1">
                        <div class="flex items-center gap-x-2">
                            <input type="radio" name="gender" id="male" value="male" {{ $user->gender == 'male' ? 'checked' : ''}}
                                class="p-3 border border-gray-700 text-primary form-radio focus:ring-primary">
                            <label for="male" class="text-gray-600">Laki Laki</label>
                        </div>
                        <div class="flex items-center gap-x-2">
                            <input type="radio" name="gender" id="female" value="female" {{ $user->gender == 'female' ? 'checked' : ''}}
                                class="p-3 border border-gray-700 text-primary form-radio focus:ring-primary">
                            <label for="female" class="text-gray-600">Perempuan</label>
                        </div>
                    </div>
                    @error('gender')
                        <span class="mt-1 text-red-500">Mohon memilih jenis kelamin terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <hr class="my-10 text-gray-500" />

            <div class="text-lg font-semibold text-primary my-3">Data Usaha</div>
            <div class="flex flex-col w-full gap-2 mb-4">
                <label for="name">Nama / Ide Usaha</label>
                <input id="name" name="name" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->name : NULL }} "  >
                @error('name')
                    <span class="mt-1 text-red-500">Mohon menulis nama / ide usaha terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex md:flex-row flex-col w-full gap-6">
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="state">Provinsi</label>
                    <div class="relative">
                        <select name="state" id="state"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Provinsi</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_code }}" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->state_code == $state->state_code ? 'selected' : '' : '' }}>{{ $state->state_name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('state')
                        <span class="mt-1 text-red-500">Mohon memilih data provinsi terlebih dahulu!</span>
                    @enderror
                </div>
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="city">Kabupaten</label>
                    <div class="relative">
                        <select name="city" id="city"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Kota / Kabupaten</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->city_code }}" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->city_code == $city->city_code ? 'selected' : '' : ''}}>{{ ucwords(strtolower($city->city_name)) ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('city')
                        <span class="mt-1 text-red-500">Mohon memilih data kota / kabupaten terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <div class="flex md:flex-row flex-col w-full gap-6 mt-4">
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="sector">Kecamatan</label>
                    <div class="relative">
                        <select name="sector" id="sector"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Kecamatan</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->sector_code }}" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->sector_code == $sector->sector_code ? 'selected' : '' : '' }}>{{ ucwords(strtolower($sector->sector_name)) ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('sector')
                        <span class="mt-1 text-red-500">Mohon memilih data kecamatan terlebih dahulu!</span>
                    @enderror
                </div>
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="village">Kelurahan</label>
                    <div class="relative">
                        <select name="village" id="village"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Kelurahan</option>
                            @foreach ($villages as $village)
                                <option value="{{ $village->village_code }}" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->village_code == $village->village_code ? 'selected' : '' : ''}}>{{ ucwords(strtolower($village->village_name)) ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('village')
                        <span class="mt-1 text-red-500">Mohon memilih data desa terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-full gap-2 my-4">
                <label for="address">Alamat Usaha</label>
                <textarea id="address" name="address" type="text" placeholder="Alamat Usaha Anda" rows="3"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->address : NULL }}</textarea>
                @error('address')
                    <span class="mt-1 text-red-500">Mohon menulis alamat usaha terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-full md:w-6/12 gap-2 my-4">
                <label for="business_type_id">Jenis Usaha</label>
                <div class="relative">
                        <select name="business_type_id" id="business_type_id"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Jenis Usaha</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->business_type_id == $type->id ? 'selected' : '' : '' }}>{{ $type->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                @error('business_type_id')
                    <span class="mt-1 text-red-500">Mohon memilih satu (1) jenis usaha terlebih dahulu!</span>
                @enderror
                <label for="nib">NIB</label>
                <input placeholder="xxxxxxxxxx" id="nib" name="nib" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->nib : NULL }}"  >
                @error('nib')
                    <span class="mt-1 text-red-500">Mohon menulis nib terlebih dahulu!</span>
                @enderror
                <label for="nib_created_at">Tahun Pembuatan NIB</label>
                <input placeholder="20xx" id="nib_created_at" name="nib_created_at" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->nib_created_at : NULL }}"  >
                @error('nib_created_at')
                    <span class="mt-1 text-red-500">Mohon menulis tahun pembuatan nib terlebih dahulu!</span>
                @enderror
            </div>

            <hr class="my-10 text-gray-500" />

            <div class="text-lg font-semibold text-primary my-3">Data Marketing</div>

            <div class="flex md:flex-row flex-col w-full gap-6">
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="ig_account">Akun IG Usaha</label>
                    <input placeholder="https://instagram.com/akuninstagram" id="ig_account" name="ig_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->ig_account : NULL }}"  >
                    @error('ig_account')
                        <span class="mt-1 text-red-500">Mohon menulis akun instagram terlebih dahulu!</span>
                    @enderror
                    <label for="fb_account">Akun FB Usaha</label>
                    <input placeholder="https://facebook.com/akunfacebook" id="fb_account" name="fb_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->fb_account : NULL }}"  >
                    @error('fb_account')
                        <span class="mt-1 text-red-500">Mohon menulis akun facebook terlebih dahulu!</span>
                    @enderror
                    <label for="tiktok_account">Akun Tiktok Usaha</label>
                    <input placeholder="https://tiktok.com/@akuntiktok" id="tiktok_account" name="tiktok_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->tiktok_account : NULL }}"  >
                    @error('tiktok_account')
                        <span class="mt-1 text-red-500">Mohon menulis akun tiktok terlebih dahulu!</span>
                    @enderror
                </div>
                <div class="flex flex-col md:w-6/12 w-full gap-2">
                    <label for="business_site">Situs Usaha</label>
                    <input placeholder="https://websiteusahaanda.com/" id="business_site" name="business_site" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->business_site : NULL }}"  >
                    @error('business_site')
                        <span class="mt-1 text-red-500">Mohon menulis situs / website usaha terlebih dahulu!</span>
                    @enderror
                    <label for="community">Komunitas Usaha</label>
                    <input placeholder="Komunitas Anda" id="community" name="community" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->community : NULL }}"  >
                    @error('community')
                        <span class="mt-1 text-red-500">Mohon menulis komunitas usaha terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-full md:w-6/12 gap-2 my-4">
                <label for="platforms">Platform Usaha</label>
                <select name="platforms[]" data-placeholder=":: Pilih Platform"
                id="platforms" class="w-full"  multiple style="background-color: ;" style="width: 100%">
                    <option value="shopee" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ?  isExistPlatform($user->hasParticipant->hasBusiness->platforms, 'shopee') ? 'selected' : '' : '' }}>Shopee</option>
                    <option value="tokopedia" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'tokopedia') ? 'selected' : '' : '' }}>Tokopedia</option>
                    <option value="lazada" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms, 'lazada') ? 'selected' : '' : '' }}>Lazada</option>
                    <option value="bukalapak" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'bukalapak') ? 'selected' : '' : '' }}>Bukalapak</option>
                </select>
                @error('platforms[]')
                    <span class="mt-1 text-red-500">Mohon memilih minimal satu (1) platform usaha terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 gap-2">
                <a href="{{ route('dashboard.profile.index') }}" type="button" class="border border-primary text-primary font-semibold py-2 px-4 rounded">Batal</a>
                <button type="submit" class="btn btn-primary text-white font-semibold py-2 px-4 rounded">Simpan Profile</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@section('extra-js')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.js" integrity="sha512-PWzfW6G+AwNx/faHiIF20Q+enGoRndfrJrVc0JGj1y59W6WxkpzCfe0tt34qqK9bCFAXCE/t/O7nzQ8WXnw1vQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

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

    new SlimSelect({
            select: '#platforms',
            settings: {
              placeholderText: 'Pilih Kategori',
            }
        });

    const alertConfirm = (title = 'Apakah anda yakin?', text = 'Aksi tidak dapat diurungkan!', confirmButtonText = 'Iya', cancelButtonText = 'Batal') => {
        return new Promise(resolve => {
            swal.fire({
                title: title,
                icon: 'question',
                text: text,
                type: 'warning',
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonText: cancelButtonText,
                confirmButtonText: confirmButtonText,
                confirmButtonColor: '#1B58C0',
            }).then(function(result) {
                if (result.value) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            });
        });
    }
    document.querySelectorAll('.form-delete-mentor').forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            alertConfirm('Apakah anda yakin ?', 'Data yang anda hapus tidak dapat dipulihkan kembali!').then(function(yes) {
                if (yes) {
                    e.target.submit();
                }
            })
        });
    });

    function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewImage = document.getElementById('preview-image');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Tampilkan gambar yang dipilih

                    // Membuat objek gambar dengan dimensi 600x400 piksel
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        const maxWidth = 600;
                        const maxHeight = 400;

                        let width = img.width;
                        let height = img.height;

                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }

                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);
                        previewImage.src = canvas.toDataURL(); // Mengganti gambar dengan dimensi baru
                    };
                };
                reader.readAsDataURL(file);
            } else {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = "{{ asset('images/news/placeholder.png') }}"; // Kembalikan ke gambar placeholder
                previewImage.style.display = 'none'; // Sembunyikan gambar yang dipilih
            }
        }

        const slimSelectState = new SlimSelect({
        select: '#state',
        settings: {
            placeholderText: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->state_code == NULL) ? NULL : $user->hasParticipant->hasState->state_name : NULL }} ',
            value:  '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->state_code == NULL) ? NULL : $user->hasParticipant->hasState->state_code : NULL }} ',
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
            placeholderText: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->city_code == NULL) ? NULL : ucwords(strtolower($user->hasParticipant->hasCity->city_name)) : NULL }} ',
            value: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->city_code == NULL) ? NULL : $user->hasParticipant->hasCity->city_code : NULL }} ',
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
            placeholderText: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->sector_code == NULL) ? NULL : ucwords(strtolower($user->hasParticipant->hasSector->sector_name)) : NULL }} ',
            value: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->sector_code == NULL) ? NULL : $user->hasParticipant->hasSector->sector_code : NULL }} ',
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
            placeholderText: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->village_code == NULL) ? NULL : ucwords(strtolower($user->hasParticipant->hasVillage->village_name)) : NULL }} ',
            value: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->village_code == NULL) ? NULL : $user->hasParticipant->hasVillage->village_code : NULL }} ',
        }
    });

    const slimSelectType = new SlimSelect({
        select: '#bussiness_type_id',
        settings: {
            placeholderText: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->hasBusiness->business_type_id == NULL) ? NULL : $user->hasParticipant->hasBusiness->hasBusinessType->name : NULL }} ',
            value: '{{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? ($user->hasParticipant->hasBusiness->business_type_id == NULL) ? NULL : $user->hasParticipant->hasBusiness->business_type_id : NULL }} ',
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
                for (var i = 0; i < cities.length; i ++) {
                    const citiesNameTitleCase = toTitleCase(cities[i].city_name);
                    assignCityOptions[i] = { 'text' : citiesNameTitleCase , 'value' : cities[i].city_code };
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
                for (var i = 0; i < sectors.length; i ++) {
                    const sectorsNameTitleCase = toTitleCase(sectors[i].sector_name);
                    assignSectorOptions[i] = { 'text' : sectorsNameTitleCase , 'value' : sectors[i].sector_code };
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
                for (var i = 0; i < villages.length; i ++) {
                    const villageNameTitleCase = toTitleCase(villages[i].village_name);
                    assignVillageOptions[i] = { 'text' : villageNameTitleCase, 'value' : villages[i].village_code };
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
