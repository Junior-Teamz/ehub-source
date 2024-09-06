@extends('landing.layouts.app')
@section('extra-title') Edit ProfilKu @endsection

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
<div class="w-full">
    <div class="flex flex-col w-full mb-8 py-8 md:py-16 md:px-12">
        <div class="flex-col bg-white rounded-xl py-8 md:p-8 md:drop-shadow-lg">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold text-primary">Edit Profil</h2>
            </div>
            <form action="{{ route('clientarea.profile.update') }}" class="mt-8" method="POST" enctype="multipart/form-data">
                @csrf
                <h3 class="text-lg font-semibold text-primary my-3">Data Diri</h3>

                <div class="flex mb-4">
                    <div class="flex flex-col mb-4 gap-2">
                        <label class="font-semibold mt-3 mb-1">Foto Profil</label>
                        <span for="avatar" class="text-xs block my-1">Keterangan Upload : (Maksimal: 2MB, Dimensi: 800x800 piksel)</span>
                        <div id="image-preview-placeholder" class="h-[200px] w-[200px] rounded-2xl border-dashed border-2 border-primary bg-gray-300 cursor-pointer" onclick="document.getElementById('image-input').click()">
                        <img id="preview-image" class="w-[195px] h-[195px] object-cover rounded-2xl" src="{{ $user->hasParticipant  ? $user->hasParticipant->avatar_url ?? asset('images/news/placeholder.png') : asset('images/news/placeholder.png') }}" onerror="this.src='{{ asset('images/news/placeholder.png') }}'" alt="Avatar Placeholder">
                        </div>
                        <input type="file" name="avatar" id="image-input" style="display: none;" onchange="previewImage(event)">
                        @error('avatar')
                            <span class="mt-1 text-red-500">{{ $errors->first('avatar') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="fullname">Nama Lengkap<span class="text-red-500">*</span></label>
                            <input id="fullname" name="fullname" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('fullname', $user->fullname) }}"
                            class="w-full py-2.5 px-3 rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"/>
                            @error('fullname')
                                <span class="mt-1 text-red-500">{{ $errors->first('fullname') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="phone_number">Nomor Whatsapp<span class="text-red-500">*</span></label>
                            <input id="phone_number" name="phone_number" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('phone_number', $user->phone) }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"  >
                            @error('phone_number')
                                <span class="mt-1 text-red-500">{{ $errors->first('phone_number') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="email">Email<span class="text-red-500">*</span></label>
                            <input id="email" name="email" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('email', $user->email) }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"  >
                            @error('email')
                                <span class="mt-1 text-red-500">{{ $errors->first('email') }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="born_place">Tempat Lahir</label>
                            <input id="born_place" name="born_place" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('born_place', $user->hasParticipant ? $user->hasParticipant->born_place : '')  }}"  >
                            @error('born_place')
                                <span class="mt-1 text-red-500">{{ $errors->first('born_place') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="born_date">Tanggal Lahir</label>
                            <input id="born_date" name="born_date" type="date" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('born_date', $user->hasParticipant ? $user->hasParticipant->born_date : '') }}"  >
                            @error('born_date')
                                <span class="mt-1 text-red-500">{{ $errors->first('born_date') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" class="mt-1" for="gender">Jenis Kelamin</label>
                            <div class="flex flex-row items-center gap-x-4 mt-1">
                                <div class="flex items-center gap-x-2">
                                    <input type="radio" name="gender" id="male" value="male" {{ old('gender', $user->hasParticipant ? $user->hasParticipant->gender : '') == 'male' ? 'checked' : ''}}
                                        class="p-3 border border-gray-700 text-primary form-radio focus:ring-primary">
                                    <label class="font-semibold mb-1" for="male" class="text-gray-600">Laki Laki</label>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <input type="radio" name="gender" id="female" value="female" {{ old('gender', $user->hasParticipant ? $user->hasParticipant->gender : '') == 'female' ? 'checked' : ''}}
                                        class="p-3 border border-gray-700 text-primary form-radio focus:ring-primary">
                                    <label class="font-semibold mb-1" for="female" class="text-gray-600">Perempuan</label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="mt-1 text-red-500">{{ $errors->first('gender') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="my-10 text-gray-500" />

                <h3 class="text-lg font-semibold text-primary my-3">Data Usaha</h3>
                <div class="flex flex-col w-full gap-2 mb-4">
                    <label class="font-semibold mb-1" for="name">Nama / Ide Usaha</label>
                    <input id="name" name="name" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('name', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->name : '') }} "  >
                    @error('name')
                        <span class="mt-1 text-red-500">{{ $errors->first('name') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <label class="font-semibold mb-1" for="state">Provinsi</label>
                        <div class="relative">
                            <select name="state" id="state"
                                class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                                <option value="" data-placeholder="true"></option>
                                @foreach ($states as $state)
                                    <option class="capitalize" value="{{ $state->state_code }}" {{ old('state_code', $user->hasParticipant ? $user->hasParticipant->state_code : '') == $state->state_code ? 'selected' : '' }}>{{ ucwords(strtolower($state->state_name))  ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('state')
                            <span class="mt-1 text-red-500">{{ $errors->first('state') }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <label class="font-semibold mb-1" for="city">Kabupaten</label>
                        <div class="relative">
                            <select name="city" id="city"
                                class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                                <option value="" data-placeholder="true"></option>
                                @foreach ($cities as $city)
                                    <option class="capitalize" value="{{ $city->city_code }}" {{ old('city_code', $user->hasParticipant ? $user->hasParticipant->city_code : '') == $city->city_code ? 'selected' : '' }}>{{ ucwords(strtolower($city->city_name)) ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city')
                            <span class="mt-1 text-red-500">{{ $errors->first('city') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6 mt-4">
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <label class="font-semibold mb-1" for="sector">Kecamatan</label>
                        <div class="relative">
                            <select name="sector" id="sector"
                                class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                                <option value="" data-placeholder="true"></option>
                                @foreach ($sectors as $sector)
                                    <option class="capitalize" value="{{ $sector->sector_code }}" {{ old('sector_code', $user->hasParticipant ? $user->hasParticipant->sector_code : '') == $sector->sector_code ? 'selected' : '' }}>{{ ucwords(strtolower($sector->sector_name)) ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('sector')
                            <span class="mt-1 text-red-500">{{ $errors->first('sector') }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <label class="font-semibold mb-1" for="village">Kelurahan</label>
                        <div class="relative">
                            <select name="village" id="village"
                                class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                                <option value="" data-placeholder="true"></option>
                                @foreach ($villages as $village)
                                    <option class="capitalize" value="{{ $village->village_code }}" {{ old('village_code', $user->hasParticipant ? $user->hasParticipant->village_code : '') == $village->village_code ? 'selected' : '' }}>{{ ucwords(strtolower($village->village_name)) ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('village')
                            <span class="mt-1 text-red-500">{{ $errors->first('village') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-full gap-2 my-4">
                    <label class="font-semibold mb-1" for="address">Alamat Usaha</label>
                    <textarea id="address" name="address" type="text" placeholder="Alamat Usaha Anda" rows="3"
                            class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">{{ old('address', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->address : '') }}</textarea>
                    @error('address')
                        <span class="mt-1 text-red-500">{{ $errors->first('address') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full md:w-6/12 gap-2 my-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="business_type_id">Jenis Usaha</label>
                        <div class="relative">
                                <select name="business_type_id" id="business_type_id"
                                    class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                                    <option value="" data-placeholder="true"></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ old('business_type_id', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->business_type_id : '') == $type->id ? 'selected' : '' }}>{{ $type->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @error('business_type_id')
                            <span class="mt-1 text-red-500">{{ $errors->first('business_type_id') }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="nib">NIB</label>
                        <input placeholder="xxxxxxxxxx" id="nib" name="nib" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('nib', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->nib : '') }}"  >
                        @error('nib')
                            <span class="mt-1 text-red-500">{{ $errors->first('nib') }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="nib_created_at">Tahun Pembuatan NIB</label>
                        <input placeholder="20xx" id="nib_created_at" name="nib_created_at" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('nib_created_at', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->nib_created_at : '') }}"  >
                        @error('nib_created_at')
                            <span class="mt-1 text-red-500">{{ $errors->first('nib_created_at') }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="my-10 text-gray-500" />

                <h3 class="text-lg font-semibold text-primary my-3">Data Marketing</h3>

                <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="ig_account">Akun IG Usaha</label>
                            <input placeholder="https://instagram.com/akuninstagram" id="ig_account" name="ig_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('ig_account', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->ig_account : '') }}"  >
                            @error('ig_account')
                                <span class="mt-1 text-red-500">{{ $errors->first('ig_account') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="fb_account">Akun FB Usaha</label>
                            <input placeholder="https://facebook.com/akunfacebook" id="fb_account" name="fb_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('fb_account', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->fb_account : '') }}"  >
                            @error('fb_account')
                                <span class="mt-1 text-red-500">{{ $errors->first('fb_account') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="tiktok_account">Akun Tiktok Usaha</label>
                            <input placeholder="https://tiktok.com/@akuntiktok" id="tiktok_account" name="tiktok_account" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('tiktok_account', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->tiktok_account : '') }}"  >
                            @error('tiktok_account')
                                <span class="mt-1 text-red-500">{{ $errors->first('tiktok_account') }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-full md:w-6/12 gap-4">
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="business_site">Situs Usaha</label>
                            <input placeholder="https://websiteusahaanda.com/" id="business_site" name="business_site" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('business_site', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->business_site : '') }}"  >
                            @error('business_site')
                                <span class="mt-1 text-red-500">{{ $errors->first('business_site') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="community">Komunitas Usaha</label>
                            <input placeholder="Komunitas Anda" id="community" name="community" type="text" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('community', ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? $user->hasParticipant->hasBusiness->business_site : '') }}"  >
                            @error('community')
                                <span class="mt-1 text-red-500">{{ $errors->first('community') }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1" for="platforms">Platform Usaha</label>
                            <select name="platforms[]" multiple="multiple"
                            id="platforms" class="w-full"  multiple style="background-color: ;" style="width: 100%">
                                <option data-placeholder="true" value=""></option>
                                <option value="shopee" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ?  isExistPlatform($user->hasParticipant->hasBusiness->platforms, 'shopee') ? 'selected' : '' : '' }}>Shopee</option>
                                <option value="tokopedia" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'tokopedia') ? 'selected' : '' : '' }}>Tokopedia</option>
                                <option value="blibli" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms, 'blibli') ? 'selected' : '' : '' }}>Blibli</option>
                                <option value="lazada" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms, 'lazada') ? 'selected' : '' : '' }}>Lazada</option>
                                <option value="bukalapak" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'bukalapak') ? 'selected' : '' : '' }}>Bukalapak</option>
                                <option value="gojek" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'gojek') ? 'selected' : '' : '' }}>Gojek</option>
                                <option value="grab" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'grab') ? 'selected' : '' : '' }}>Grab</option>
                                <option value="lainnya" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'lainnya') ? 'selected' : '' : '' }}>Lainnya</option>

                            </select>
                            @error('platforms[]')
                                <span class="mt-1 text-red-500">{{ $errors->first('platforms[]') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-8 gap-2">
                    <a href="{{ route('clientarea.profile.index') }}" type="button" class="btn btn-lg btn-outline-primary">Batal</a>
                    <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
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
              placeholderText: 'Pilih Platform Usaha',
            }
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
            placeholderText: 'Pilih Kota / Kabupaten ',
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
            placeholderText: 'Pilih Desa / Kelurahan',
        }
    });

    const slimSelectType = new SlimSelect({
        select: '#business_type_id',
        settings: {
            placeholderText: 'Pilih Jenis Usaha',
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
