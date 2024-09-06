@extends('dashboard.layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.css" integrity="sha512-GvqWM4KWH8mbgWIyvwdH8HgjUbyZTXrCq0sjGij9fDNiXz3vJoy3jCcAaWNekH2rJe4hXVWCJKN+bEW8V7AAEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .ss-main {
            padding: 10px 12px;;
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
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-8">Edit Wirausaha</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.entrepreneurs.update', $entrepreneur->id) }}">
            @csrf
            <div class="flex w-full items-center mb-8">
                <h4 class="mr-2 text-xl font-bold">Identitas Diri</h4>
                <span class="border-t-2 border-gray-200 flex-1"></span>
            </div>
            <div class="flex flex-col w-6/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Foto Wirausaha <span class="text-xs font-normal">(Max: 8MB)</span></label>
                <div class="w-full flex items-start gap-x-8">
                    <div class="flex w-4/12">
                        <label
                            class="border border-primary rounded-lg px-5 py-3 flex items-center cursor-pointer hover:shadow-md">
                            <span class="text-primary mr-2">
                                <svg class="w-4 h-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1V17M17 9L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </span>
                            <p class="text-sm text-gray-800 font-semibold">Unggah Foto</p>
                            <input type="file" name="photo" onchange="previewPhoto()" class="hidden" accept=".png,.jpg,.jpeg,.svg" value=""/>
                        </label>
                    </div>
                    <div class="flex w-8/12">
                        <div class="relative flex items-center justify-center">
                            <img id="photo" src="{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->avatar_url ?? asset('images/preview-img.svg')) :  asset('images/preview-img.svg') }}" class="w-full object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('photo')
                    <span class="mt-1 text-red-500">{{ $errors->first('photo') }}</span>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="fullname" placeholder="Nama Wirausaha" value="{{ old('fullname', $entrepreneur->fullname) }}" required
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('fullname')
                        <span class="mt-1 text-red-500">{{ $errors->first('fullname') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" placeholder="Email Wirausaha" value="{{ old('email', $entrepreneur->email) }}" autocomplete="off" required
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('email')
                        <span class="mt-1 text-red-500">{{ $errors->first('email') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Nomor Telepon / Whatsapp <span class="text-red-500">*</span></label>
                    <input type="number" name="phone_number" placeholder="Nomor Telepon Wirausaha" required
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary"
                        value="{{ old('phone_number', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->phone_number ?? $entrepreneur->phone) : $entrepreneur->phone) }}">
                    @error('phone_number')
                        <span class="mt-1 text-red-500">{{ $errors->first('phone_number') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Tempat Lahir </label>
                    <input type="text" name="born_place" placeholder="Tempat Lahir" value="{{ old('born_place', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->born_place : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('born_place')
                        <span class="mt-1 text-red-500">{{ $errors->first('born_place') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Tanggal Lahir </label>
                    <input type="date" name="born_date" placeholder="Tanggal Lahir" value="{{ old('born_date', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->born_date : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('born_date')
                        <span class="mt-1 text-red-500">{{ $errors->first('born_date') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 font-semibold mb-4">Jenis Kelamin </span>
                    <div class="flex flex-row items-center gap-x-4">
                        <div class="flex items-center gap-x-2">
                            <input type="radio" name="gender" id="male" value="male" {{ old('gender', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->gender : '') == 'male' ? 'checked' : ''}}
                                class="p-3 border border-gray-200">
                            <label for="male" class="text-gray-600">Laki Laki</label>
                        </div>
                        <div class="flex items-center gap-x-2">
                            <input type="radio" name="gender" id="female" value="female" {{ old('gender', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->gender : '') == 'female' ? 'checked' : ''}}
                                class="p-3 border border-gray-200">
                            <label for="female" class="text-gray-600">Perempuan</label>
                        </div>
                    </div>
                    @error('gender')
                        <span class="mt-1 text-red-500">{{ $errors->first('gender') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Password<span class="text-xs ml-2">(Isi kolom password ini jika ingin mengubah password)</span></label>
                    <input type="password" name="password" placeholder="Password" value="{{ old('password') }}" autocomplete="new-password" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" />
                    @error('password')
                        <span class="mt-1 text-red-500">{{ $errors->first('password') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik Ulang Password" value="{{ old('password_confirmation') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('password_confirmation')
                        <span class="mt-1 text-red-500">{{ $errors->first('password_confirmation') }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex w-full items-center my-8">
                <h4 class="mr-2 text-xl font-bold">Data Usaha</h4>
                <span class="border-t-2 border-gray-200 flex-1"></span>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Nama / Ide Usaha </label>
                    <input type="text" name="business_name" placeholder="Nama Usaha / Ide Usaha yang akan dikembangkan" value="{{ old('business_name', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->name : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('business_name')
                        <span class="mt-1 text-red-500">{{ $errors->first('business_name') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Jenis Usaha </label>
                    <select name="business_type_id" id="business_type"
                        class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 text-gray-600">
                        <option data-placeholder="true"></option>
                        @foreach($business_types as $business_type)
                            <option value="{{ $business_type->id }}" {{ old('business_type_id', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->business_type_id : '') : '') == $business_type->id ? 'selected' : '' }}>{{ $business_type->name }}</option>
                        @endforeach
                    </select>
                    @error('business_type_id')
                        <span class="mt-1 text-red-500">{{ $errors->first('business_type_id') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">NIB </label>
                    <input type="text" name="nib_number" placeholder="Nomor Induk Berusaha" value="{{ old('nib_number', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->nib : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('nib_number')
                        <span class="mt-1 text-red-500">{{ $errors->first('nib_number') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Tahun Pembuatan NIB </label>
                    <input type="text" name="nib_created_at" placeholder="Tahun Pembuatan NIB" value="{{ old('nib_created_at', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->nib_created_at : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('nib_created_at')
                        <span class="mt-1 text-red-500">{{ $errors->first('nib_created_at') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Provinsi</label>
                    <select name="state_id" id="state"
                        class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                        <option data-placeholder="true"></option>
                        @foreach ($states as $state)
                            <option value="{{ $state->state_code }}" {{ old('state_id', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->state_code : '') == $state->state_code ? 'selected' : '' }}>{{ $state->state_name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('state_id')
                        <span class="mt-1 text-red-500">{{ $errors->first('state_id') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold  mb-1">Kota</label>
                    <select name="city_id" id="city"
                        class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                        <option data-placeholder="true"></option>
                        @forelse ($cities as $city)
                            <option value="{{ $city->city_code }}" {{ old('city_id', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->city_code : '') == $city->city_code ? 'selected' : '' }}>{{ $city->city_name ?? '' }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('city_id')
                        <span class="mt-1 text-red-500">{{ $errors->first('city_id') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold  mb-1">Kecamatan</label>
                    <select name="sector_id" id="sector"
                        class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                        <option data-placeholder="true"></option>
                        @forelse ($sectors as $sector)
                            <option value="{{ $sector->sector_code }}" {{ old('sector_id', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->sector_code : '') == $sector->sector_code ? 'selected' : '' }}>{{ $sector->sector_name ?? '' }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('sector_id')
                        <span class="mt-1 text-red-500">{{ $errors->first('sector_id') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold  mb-1">Desa / Kelurahan</label>
                    <select name="village_id" id="village"
                        class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                        <option data-placeholder="true"></option>
                        @forelse ($villages as $village)
                            <option value="{{ $village->village_code }}" {{ old('village_id', $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->village_code : '') == $village->village_code ? 'selected' : '' }}>{{ $village->village_name ?? '' }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('village_id')
                        <span class="mt-1 text-red-500">{{ $errors->first('village_id') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col col-span-full">
                    <label class="text-gray-600 font-semibold  mb-1">Alamat Lengkap</label>
                    <textarea type="text" name="business_address" placeholder="Alamat Lengkap Usaha" rows="3"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">{{ old('business_address', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->address : '') : '') }}</textarea>
                    @error('business_address')
                        <span class="mt-1 text-red-500">{{ $errors->first('business_address') }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex w-full items-center my-8">
                <h4 class="mr-2 text-xl font-bold">Data Marketing</h4>
                <span class="border-t-2 border-gray-200 flex-1"></span>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Akun Instagram Usaha </label>
                    <input type="text" name="ig_account" placeholder="Nama Profile Akun Instagram Usaha" value="{{ old('ig_account', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->ig_account : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('ig_account')
                        <span class="mt-1 text-red-500">{{ $errors->first('ig_account') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Akun Facebook Usaha </label>
                    <input type="text" name="fb_account" placeholder="Nama Profile / Halaman Facebook Usaha" value="{{ old('fb_account', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->fb_account : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('fb_account')
                        <span class="mt-1 text-red-500">{{ $errors->first('fb_account') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Akun Tiktok Usaha </label>
                    <input type="text" name="tiktok_account" placeholder="Nama Profile Tiktok Usaha" value="{{ old('tiktok_account', $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->tiktok_account : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('tiktok_account')
                        <span class="mt-1 text-red-500">{{ $errors->first('tiktok_account') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Situs Usaha </label>
                    <input type="text" name="business_site" placeholder="Alamat URL Situs Usaha" value="{{ old('business_site',  $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->business_site : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('business_site')
                        <span class="mt-1 text-red-500">{{ $errors->first('business_site') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-semibold mb-1">Komunitas Usaha </label>
                    <input type="text" name="community" placeholder="Nama Komunitas Usaha" value="{{ old('community',  $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->community : '') : '') }}"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                    @error('community')
                        <span class="mt-1 text-red-500">{{ $errors->first('community') }}</span>
                    @enderror
                </div>
                <div class="flex flex-col col-span-full">
                    <label class="text-gray-600 font-semibold mb-2">Platform Usaha</label>
                    <div class="flex flex-col gap-4 ml-2">
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="shopee" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('shopee', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="shopee" />
                            <label for="shopee" class="ml-4 text-[#374151] cursor-pointer">Shopee</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="tokopedia" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('tokopedia', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="tokopedia" />
                            <label for="tokopedia" class="ml-4 text-[#374151] cursor-pointer">Tokopedia</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="blibli" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('blibli', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="blibli" />
                            <label for="blibli" class="ml-4 text-[#374151] cursor-pointer">Blibli</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="lazada" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('lazada', old('business_platform[]', $platforms)) ? 'checked' : '' }}  value="lazada" />
                            <label for="lazada" class="ml-4 text-[#374151] cursor-pointer">Lazada</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="bukalapak" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('bukalapak', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="bukalapak" />
                            <label for="bukalapak" class="ml-4 text-[#374151] cursor-pointer">Bukalapak</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="gojek" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('gojek', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="gojek" />
                            <label for="gojek" class="ml-4 text-[#374151] cursor-pointer">Gojek</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="grab" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('grab', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="grab" />
                            <label for="grab" class="ml-4 text-[#374151] cursor-pointer">Grab</label>
                        </div>
                        <div class="flex flex-row items-center">
                            <input type="checkbox" id="lainnya" class="p-2 text-primary border border-gray-400 rounded focus:ring-primary cursor-pointer" name="business_platform[]"
                                {{ in_array('lainnya', old('business_platform[]', $platforms)) ? 'checked' : '' }} value="lainnya" />
                            <label for="lainnya" class="ml-4 text-[#374151] cursor-pointer">Lainnya</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.entrepreneurs.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
                <button type="submit" class="btn btn-primary px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.js"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        const slimSelectState = new SlimSelect({
            select: '#state',
            settings: {
                placeholderText: 'Pilih Provinsi',
                showOptionTooltips: true,
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
                placeholderText: 'Pilih Desa / Kelurahan',
            }
        });

        const slimSelectBusinessType = new SlimSelect({
            select: '#business_type',
            settings: {
                placeholderText: 'Pilih Jenis Usaha',
            }
        });


        function previewPhoto() {
            photo.src=URL.createObjectURL(event.target.files[0]);
        }

        async function getCities(stateCode) {
            var base_url = window.location.origin;
            var url = base_url + '/api/cities/' + stateCode;
            try {
                let response = await fetch(url);
                return await response.json();
            } catch (error) {
                console.log(error);
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
                        assignCityOptions[i] = { 'text' : cities[i].city_name , 'value' : cities[i].city_code };
                    }
                    slimSelectCity.setData(assignCityOptions);
                    slimSelectCity.setSelected('');
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
                        assignSectorOptions[i] = { 'text' : sectors[i].sector_name , 'value' : sectors[i].sector_code };
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
                        assignVillageOptions[i] = { 'text' : villages[i].village_name , 'value' : villages[i].village_code };
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
