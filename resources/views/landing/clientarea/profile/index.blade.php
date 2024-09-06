@extends('landing.layouts.app')
@section('extra-title') ProfilKu @endsection

@section('content')
<div class="w-full">
    <div class="flex flex-col w-full mb-8 py-8 md:py-16 md:px-12">
        <div class="flex-col bg-white rounded-xl py-8 md:p-8 md:drop-shadow-lg">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold text-primary">Profil Saya</h2>
                <a href="{{ route('clientarea.profile.edit') }}" type="button" class="btn btn-primary text-white font-semibold py-2 px-4 rounded cursor-pointer">Edit Profil</a>
            </div>

            <h3 class="text-lg font-semibold text-primary my-3">Data Diri</h3>

            <div class="flex mb-4">
                <div class="flex flex-col mb-4 gap-2">
                    <label for="avatar" class="font-semibold  mt-3">Foto Profil</label>
                    <img class="w-[195px] h-[195px] object-cover rounded-2xl border-2 border-primary" src="{{ $user->hasParticipant ? $user->hasParticipant->avatar_url ?? asset('images/news/placeholder.png') : asset('images/news/placeholder.png') }}" alt="Avatar Placeholder" onerror="this.src='{{ asset('images/news/placeholder.png') }}'">
                </div>
                <div class="flex flex-grow"></div>
            </div>

            <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="fullname">Nama Lengkap</label>
                        <input id="fullname" type="text" value="{{ $user->fullname }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled />
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="phone_number">Nomor Whatsapp</label>
                        <input id="phone_number" type="text" value="{{ $user->phone }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="phone_number">Email</label>
                        <input id="phone_number" type="text" value="{{ $user->email }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="born_place">Tempat Lahir</label>
                        <input id="born_place" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->born_place : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="born_date">Tanggal Lahir</label>
                        <input id="born_date" type="date" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->born_date : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="gender">Jenis Kelamin</label>
                        <input id="gender" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? ($user->gender=='male') ? 'Pria' : 'Wanita' : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
            </div>
            <hr class="my-10 text-gray-500" />

            <h3 class="text-lg font-semibold text-primary my-3">Data Usaha</h3>
            <div class="flex flex-col w-full gap-2 mb-4">
                <label class="font-semibold mb-1" for="name">Nama / Ide Usaha</label>
                <input id="name" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->name : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
            </div>
            <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="state_code">Provinsi</label>
                        <input id="state_code" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ?  $user->hasParticipant->state_code == NULL ? '-' : $user->hasParticipant->hasState->state_name : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="sector_code">Kecamatan</label>
                        <input id="sector_code" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->sector_code == NULL ? '-' : ucwords(strtolower($user->hasParticipant->hasSector->sector_name)) : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="city_code">Kabupaten</label>
                        <input id="city_code" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->city_code == NULL ? '-' : ucwords(strtolower($user->hasParticipant->hasCity->city_name)) : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="village_code">Kelurahan</label>
                    <input id="village_code" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->village_code == NULL ? '-' : ucwords(strtolower($user->hasParticipant->hasVillage->village_name)) : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full gap-2 my-4">
                <label class="font-semibold mb-1" for="address">Alamat Usaha</label>
                <textarea id="address" name="address" type="text" placeholder="Alamat Usaha Anda" rows="3"
                class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->address : '-' }}</textarea>
            </div>
            <div class="flex flex-col w-full md:w-6/12 gap-2 my-4">
                <div class="flex flex-col">
                   <label class="font-semibold mb-1" for="business_type_id">Jenis Usaha</label>
                    <input id="business_type_id" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->business_type_id == NULL ? '-' : $user->hasParticipant->hasBusiness->hasBusinessType->name : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="nib">NIB</label>
                    <input id="nib" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->nib : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="nib_created_at">Tahub Pembuatan NIB</label>
                    <input id="nib_created_at" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->nib_created_at : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                </div>
            </div>

            <hr class="my-10 text-gray-500" />

            <h3 class="text-lg font-semibold text-primary my-3">Data Marketing</h3>

            <div class="flex flex-col md:flex-row w-full gap-4 md:gap-6">
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="ig_account">Akun IG Usaha</label>
                    <input id="ig_account" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->ig_account : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="fb_account">Akun FB Usaha</label>
                        <input id="fb_account" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->fb_account : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="tiktok_account">Akun Tiktok Usaha</label>
                        <input id="tiktok_account" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->tiktok_account : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-6/12 gap-4">
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="business_site">Situs Usaha</label>
                        <input id="business_site" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->business_site : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold mb-1" for="community">Komunitas Usaha</label>
                        <input id="community" type="text" value="{{ $user->hasParticipant && $user->hasParticipant->hasBusiness ? $user->hasParticipant->hasBusiness->community : '-' }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" disabled>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full md:w-6/12 gap-2 my-6">
                <label class="font-semibold mb-1" for="platforms">Platform Usaha</label>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_shopee" type="checkbox" name="platforms" value="shopee" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'shopee') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_shopee" class="ml-2">Shopee</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary focus:ring-primary h-4 w-4" id="platforms_tokopedia" type="checkbox" name="platforms" value="tokopedia" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'tokopedia') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_tokopedia" class="ml-2">Tokopedia</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_blibli" type="checkbox" name="platforms" value="blibli" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'blibli') ? 'checked' : '' : ''}} disabled>
                    <label for="platforms_blibli" class="ml-2">Blibli</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_lazada" type="checkbox" name="platforms" value="lazada" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'lazada') ? 'checked' : '' : ''}} disabled>
                    <label for="platforms_lazada" class="ml-2">Lazada</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_bukalapak" type="checkbox" name="platforms" value="bukalapak" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'bukalapak') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_bukalapak" class="ml-2">Bukalapak</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_gojek" type="checkbox" name="platforms" value="gojek" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'gojek') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_gojek" class="ml-2">Gojek</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_grab" type="checkbox" name="platforms" value="grab" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'grab') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_grab" class="ml-2">Grab</label>
                </div>
                <div>
                    <input class="p-2 rounded-md text-primary  focus:ring-primary h-4 w-4" id="platforms_lainnya" type="checkbox" name="platforms" value="lainnya" {{ ($user->hasParticipant && $user->hasParticipant->hasBusiness) ? isExistPlatform($user->hasParticipant->hasBusiness->platforms,  'lainnya') ? 'checked' : '' : '' }} disabled>
                    <label for="platforms_lainnya" class="ml-2">Lainnya</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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


</script>

@endsection
