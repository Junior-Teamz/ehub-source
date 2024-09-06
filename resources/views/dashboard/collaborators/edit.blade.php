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
        <h1 class="text-xl text-gray-800 mb-8">Edit Kolaborator</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.collaborators.update', $collaborator->id) }}">
            @csrf
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Kolaborator <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="Nama Kolaborator" value="{{ old('name', $collaborator->name) }}"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" >
                @error('name')
                    <span class="mt-1 text-red-500">Mohon menuliskan nama badan usaha / lembaga kolaborator terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Pimpinan <span class="text-red-500">*</span></label>
                <input type="text" name="director_name" placeholder="Nama Pimpinan" value="{{ old('director_name', $collaborator->director_name) }}"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" >
                @error('director_name')
                    <span class="mt-1 text-red-500">Mohon menuliskan nama pimpinan kolaborator terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" placeholder="Email Kolaborator" value="{{ old('email', $collaborator->hasUser->email) }}" disabled
                    class="w-full py-2.5 px-3 bg-gray-200 rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                @error('email')
                    <span class="mt-1 text-red-500">Mohon menuliskan email terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="number" name="phone_number" placeholder="Nomor Telepon Kolaborator" value="{{ old('phone_number', $collaborator->phone_number) }}" disabled
                    class="w-full py-2.5 px-3 bg-gray-200 rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                @error('phone_number')
                    <span class="mt-1 text-red-500">Mohon menuliskan nomor telepon terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-8">
                <span class="text-gray-600 font-semibold mb-2">Alamat <span class="text-red-500">*</span></span>
                <div class="flex flex-row items-center mb-4 ml-10 w-11/12 gap-x-6">
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Provinsi</label>
                        <select name="state_id" id="state"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Provinsi</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_code }}" {{ old('state_id', $collaborator->state_id) == $state->state_code ? 'selected' : '' }}>{{ $state->state_name ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <span class="mt-1 text-red-500">Mohon memilih provinsi kolaborator terlebih dahulu!</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Kota</label>
                        <select name="city_id" id="city"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option value="" default>:: Pilih Kota</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->city_code }}" {{ old('city_id', $collaborator->city_id) == $city->city_code ? 'selected' : '' }}>{{ Str::ucfirst($city->city_name) ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="mt-1 text-red-500">Mohon memilih kota / kabupaten kolaborator terlebih dahulu!</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col ml-10 w-11/12">
                    <label class="text-gray-600 mb-1">Alamat Lengkap</label>
                    <textarea type="text" name="address" placeholder="Alamat Lengkap" rows="3"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">{{ old('address', $collaborator->address) }}</textarea>
                    @error('address')
                        <span class="mt-1 text-red-500">Mohon menuliskan alamat lengkap kolaborator terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" class="w-full bg-white rounded-md" placeholder="Deskripsi program">{{ old('description', $collaborator->description) }}</textarea>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Platform Kolaborator</label>
                <input type="text" name="site" placeholder="Platform Kolaborator"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('site', $collaborator->site) }}">
                @error('site')
                    <span class="mt-1 text-red-500">Mohon menuliskan website / platform kolaborator terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="tag_id[]" id="tag" multiple="multiple" data-placeholder=":: Pilih Kategori Wirausaha"
                    class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                    @php
                        $collaboratorTagId = 0;
                    @endphp
                    @foreach ($tags as $tag)
                        @foreach ($collaborator->hasTags as $collaboratorTag)
                            @if ($collaboratorTag->id == $tag->id)
                                @php
                                    $collaboratorTagId = $collaboratorTag->id;
                                @endphp
                                @break
                            @endif
                        @endforeach
                        <option value="{{ $tag->id }}" {{ old('tag_id', $collaboratorTagId) == $tag->id ? 'selected' : '' }}>{{ $tag->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('tag_id')
                    <span class="mt-1 text-red-500">Mohon memilih kategori kolaborator terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col mb-6">
                <span class="text-gray-600 font-semibold mb-2">Status</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" id="status" value="1" class="sr-only peer" {{ old('status', $collaborator->status) == true ? 'checked' : '' }}>
                    <div class="w-20 h-8 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-12 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span id="labelStatus" class="ml-6 {{ $collaborator->status ? 'text-green-600' : 'text-red-600'}}">{{ $collaborator->status_label->value }}</span>
                </label>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Logo Kolaborator <span class="text-xs font-normal">(Max: 8MB)</span><span class="text-red-500">*</span></label>
                <div class="w-full flex items-start gap-x-8">
                    <div class="flex w-3/12">
                        <label
                            class="border border-primary rounded-lg px-5 py-3 flex items-center cursor-pointer hover:shadow-md">
                            <span class="text-primary mr-2">
                                <svg class="w-4 h-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1V17M17 9L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </span>
                            <p class="text-sm text-gray-800 font-semibold">Upload Image</p>
                            <input type="file" name="logo" onchange="previewLogo()" class="hidden" accept=".png,.jpg,.jpeg,.svg" value="{{ old('thubmnail') }}"/>
                        </label>
                    </div>
                    <div class="flex w-9/12">
                        <div class="relative flex items-center justify-center">
                            <img id="logo" src="{{ $collaborator->logo_url ?? asset('images/preview-img.svg') }}" class="w-full object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('logo')
                    <span class="mt-1 text-red-500">Mohon mengunggah logo kolaborator sesuai dengan kriteria yang telah ditentukan!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Foto Cover / Background Kolaborator <span class="text-xs font-normal">(Max: 8MB)</span></label>
                <div class="w-full flex items-start gap-x-8">
                    <div class="flex w-3/12">
                        <label
                            class="border border-primary rounded-lg px-5 py-3 flex items-center cursor-pointer hover:shadow-md">
                            <span class="text-primary mr-2">
                                <svg class="w-4 h-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1V17M17 9L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </span>
                            <p class="text-sm text-gray-800 font-semibold">Upload Image</p>
                            <input type="file" name="cover" onchange="previewCover()" class="hidden" accept=".png,.jpg,.jpeg,.svg" value="{{ old('thubmnail') }}"/>
                        </label>
                    </div>
                    <div class="flex w-9/12">
                        <div class="relative flex items-center justify-center">
                            <img id="cover" src="{{ $collaborator->cover_url ?? asset('images/preview-img.svg') }}" class="w-full object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('cover')
                    <span class="mt-1 text-red-500">Mohon mengunggah cover kolaborator sesuai dengan kriteria yang telah ditentukan!</span>
                @enderror
            </div>
            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.collaborators.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
                <button type="submit" class="btn btn-primary px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.js" integrity="sha512-PWzfW6G+AwNx/faHiIF20Q+enGoRndfrJrVc0JGj1y59W6WxkpzCfe0tt34qqK9bCFAXCE/t/O7nzQ8WXnw1vQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tiny.cloud/1/mgnx3lcm1bg1v85bmqfw3ogmz9vjtdxolbcs3pmx800uia9e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        const slimSelectState = new SlimSelect({
            select: '#state',
            setting: {
                showOptionTooltips: true,
            },
            events: {
                afterChange: (stateValue) => {
                    let stateCode = stateValue[0].value;
                    if (stateCode) {
                        renderCities(stateCode);
                    } else {
                        slimSelectCity.setData([{ 'text' : ' :: Pilih kabupaten / kota', 'value' : ''}]);
                    }
                }
            }
        });

        const slimSelectCity = new SlimSelect({
            select: '#city',
            setting: {
                showOptionTooltips: true,
            }
        });

        const slimSelectTag = new SlimSelect({
            select: '#tag',
            settings: {
                showOptionTooltips: true,
                placeholderText: ':: Pilih Kategori Kolaborator',
            }
        });

        tinymce.init({
            selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        function previewLogo() {
            logo.src=URL.createObjectURL(event.target.files[0]);
        }

        function previewCover() {
            cover.src=URL.createObjectURL(event.target.files[0]);
        }

        const elStatus = document.getElementById('status');
        const elLabelStatus = document.getElementById('labelStatus');
        elStatus.addEventListener('change', (e) => {
            if (e.target.checked) {
                elLabelStatus.innerHTML = 'Aktif';
                elLabelStatus.classList.remove('text-red-600');
                elLabelStatus.classList.add('text-green-600');
            } else {
                elLabelStatus.innerHTML = 'Tidak Aktif';
                elLabelStatus.classList.remove('text-green-600');
                elLabelStatus.classList.add('text-red-600');
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
                        assignCityOptions[i] = { 'text' : cities[i].city_name , 'value' : cities[i].city_code };
                    }
                    assignCityOptions.push({ 'text' : ' :: Pilih kabupaten / kota', 'value' : ''});
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
    </script>

@endsection
