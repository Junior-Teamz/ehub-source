@extends('dashboard.layouts.app')

@section('extra-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* styling select2 single */
        .select2-container--default .select2-selection--single {
            border: 1px solid #E5E7EB !important;
        }
        .select2-container .select2-selection--single {
            height: 46px !important;
        }
        .select2-search--dropdown {
            padding: 12px 12px 8px !important;
        }
        .select2-search--dropdown .select2-search__field {
            padding: 8px 12px !important;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #E5E7EB !important;
            border-radius: 4px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 28px !important;
            top: 7px !important;
            right: 6px !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding: 8px 28px 8px 12px !important;
        }
        .select2-results__option {
            padding: 8px 12px !important;
        }
        .select2-dropdown {
            border: 1px solid  #E5E7EB !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: rgb(31 41 55 / 1);
        }
        /* styling select2 multiple */
        .select2-container .select2-selection--multiple {
            min-height: 46px;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #E5E7EB !important;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #E5E7EB !important;
        }
        .select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
            min-height: 24px;
            margin-bottom: 8px;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            margin-bottom: 5px;
            padding: 4px 8px;
            padding-left: 28px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 1.4rem;
            line-height: 1.375;
        }
    </style>
@endsection

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-8">Tambah Program Baru</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.workshops.store') }}">
            @csrf
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Program <span class="text-red-500">*</span></label>
                <input type="text" name="title" placeholder="Nama Program"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('title') }}">
                @error('title')
                    <span class="mt-1 text-red-500">Mohon menulis nama program terlebih dahulu!</span>
                @enderror
            </div>
            @role('admin')
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Kolaborator <span class="text-red-500">*</span></label>
                <select name="collaborator_id[]" multiple="multiple" data-placeholder=":: Pilih Kolaborator"
                    class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-search" style="width: 100%">
                    @foreach ($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}" {{ old('collaborator_id') == $collaborator->id ? 'selected' : '' }}>{{ $collaborator->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('collaborator_id')
                    <span class="mt-1 text-red-500">Mohon memilih satu (1) kolaborator terlebih dahulu!</span>
                @enderror
            </div>
            @endrole
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="tag_id[]" multiple="multiple" data-placeholder=":: Pilih kategori program"
                    class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-multiple" style="width: 100%">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>{{ $tag->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('tag_id')
                    <span class="mt-1 text-red-500">Mohon memilih minimal (1) kategori terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Diperuntukkan <span class="text-red-500">*</span></label>
                <select name="target_id[] " multiple="multiple" data-placeholder=":: Pilih target program"
                    class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-multiple" style="width: 100%">
                    @foreach ($targets as $target)
                        <option value="{{ $target->id }}" {{ old('target_id') == $target->id ? 'selected' : '' }}>{{ $target->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('target_id')
                    <span class="mt-1 text-red-500">Mohon memilih target program terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Penyelenggaraan <span class="text-red-500">*</span></label>
                <div class="flex flex-row items-center gap-x-6">
                    <div class="flex items-center">
                        <input type="radio" name="place" id="place1" value="offline" {{ old('place') == 'offline' ? 'checked' : '' }}
                            class="appearance-none w-5 h-5 text-primary focus-within:bg-primary focus:bg-primary focus:ring-primary checked:bg-primary checked:ring-primary mr-3">
                        <label for="place1" class="text-gray-800">Offline</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="place" id="place2" value="online" {{ old('place') == 'online' ? 'checked' : '' }}
                            class="appearance-none w-5 h-5 text-primary focus-within:bg-primary focus:bg-primary focus:ring-primary checked:bg-primary checked:ring-primary mr-3" >
                        <label for="place2" class="text-gray-800">Online</label>
                    </div>
                </div>
                @error('place')
                    <span class="mt-1 text-red-500">Mohon memilih metode penyelenggaraan program terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex-col w-11/12 ml-10 mb-8 hidden" id="elPlaceOffline">
                <div class="flex flex-row items-center mb-4 w-10/12 gap-x-6">
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Provinsi</label>
                        <select name="state_id" id="state"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-search states" style="width: 100%">
                            <option value="" default>:: Pilih Provinsi</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_code }}" {{ old('state_id') == $state->state_code ? 'selected' : '' }}>{{ $state->state_name ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <span class="mt-1 text-red-500">Mohon memilih provinsi penyelenggaraan program terlebih dahulu!</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Kota</label>
                        <select name="city_id" id="city"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-search cities" style="width: 100%">
                            <option value="" default>:: Pilih Kota</option>
                        </select>
                        @error('city_id')
                            <span class="mt-1 text-red-500">Mohon memilih kota penyelenggaraan program terlebih dahulu!</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-10/12">
                    <label class="text-gray-600 mb-1">Alamat Pelaksanaan</label>
                    <textarea type="text" name="address" placeholder="Alamat Pelaksanaan" rows="3"
                        class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="mt-1 text-red-500">Mohon menulis alamat penyelenggaraan program terlebih dahulu!</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col mb-8 w-full">
                <span class="mb-2 text-gray-600 font-semibold">Tanggal Pelaksanaan <span class="text-red-500">*</span></span>
                <div class="flex flex-row items-center w-10/12 gap-x-6">
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Mulai</label>
                        <input type="datetime-local" name="start_date"
                            class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('start_date') }}">
                        @error('start_date')
                            <span class="mt-1 text-red-500">Mohon memilih tanggal pelaksanaan program terlebih dahulu!</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-6/12">
                        <label class="text-gray-600 mb-1">Selesai</label>
                        <input type="datetime-local" name="end_date"
                            class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('end_date') }}">
                        @error('end_date')
                            <span class="mt-1 text-red-500">Mohon memilih tanggal selesainya program terlebih dahulu!</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" class="w-full bg-white rounded-md" placeholder="Deskripsi program"></textarea>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Link Program</label>
                <input type="text" name="material_links" placeholder="Link Program"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('material_links') }}">
                @error('material_links')
                    <span class="mt-1 text-red-500">Mohon mengisi link program terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-4/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Kuota <span class="text-red-500">*</span></label>
                <input type="number" name="quota" placeholder="Kuota"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('quota') }}">
                @error('quota')
                    <span class="mt-1 text-red-500">Mohon mengisi kuota terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Poster Program <span class="text-xs font-normal">(Max: 8MB)</span><span class="text-red-500">*</span></label>
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
                            <input type="file" name="thumbnail" onchange="previewPhoto()" class="hidden" accept=".png,.jpg,.jpeg,.svg" value="{{ old('thubmnail') }}"/>
                        </label>
                    </div>
                    <div class="flex 9/12">
                        <div class="relative flex items-center justify-center">
                            <img id="photo" src="{{ asset('images/preview-img.svg') }}" class="w-full object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('thumbnail')
                    <span class="mt-1 text-red-500">Mohon mengunggah poster program sesuai dengan kriteria yang ditentukan!</span>
                @enderror
            </div>
            <div class="flex flex-col w-4/12 mb-8">
                <label class="text-gray-600 font-semibold mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 select2 select2-search" style="width: 100%">
                    <option value="" default>:: Pilih Status</option>
                    <option value="unpublish" {{ old('status') == 'unpublish' ? 'selected' : '' }}>Draft</option>
                    @hasanyrole('admin|collaborator|institution')
                    <option value="ready" {{ old('status') == 'ready' ? 'selected' : '' }}>Ready To Publish</option>
                    @endhasanyrole
                    @role('admin')
                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                    @endrole
                </select>
                @error('status')
                    <span class="mt-1 text-red-500">Mohon pilih status program terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.workshops.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
                <button type="submit" id="submitButton" class="btn btn-primary px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/mgnx3lcm1bg1v85bmqfw3ogmz9vjtdxolbcs3pmx800uia9e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        const submitButton = document.getElementById('submitButton');
        const form = document.querySelector('form');

        form.addEventListener('submit', (e) => {
            
            submitButton.disabled = true;
        });

        $(document).ready(function() {
            $('.select2.select2-search').select2();
            $('.select2.select2-multiple').each(function() {
                var placeholder = $(this).data('placeholder') || 'Set placeholder with data-placeholder';
                $(this).select2({
                    placeholder: placeholder,
                    allowClear: true
                });
            });
        });
        tinymce.init({
            selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        function previewPhoto() {
            photo.src=URL.createObjectURL(event.target.files[0]);
        }
        const elPlaceOffline = document.getElementById('elPlaceOffline');
        document.querySelectorAll('input[name="place"]').forEach(place => {
            place.addEventListener('change', (e) => {
                if (e.target.checked) {
                    var valplace = e.target.value;
                    if (valplace == 'offline') {
                        elPlaceOffline.classList.remove('hidden');
                        elPlaceOffline.classList.add('flex');
                    } else {
                        elPlaceOffline.classList.remove('flex');
                        elPlaceOffline.classList.add('hidden');
                        elPlaceOffline.querySelectorAll('select, input').forEach(elements => {
                            const newEventChange = new Event("change");
                            elements.value = '';
                            elements.dispatchEvent(newEventChange);
                        });
                    }
                }
            })
        });

        $('#state').change(function () {
            const state_code = $(this).val();
            var base_url = window.location.origin;

            $('.cities').empty();
            $('#city').attr('disabled', false);
            if(state_code) {
                $.ajax({
                    type: "GET",
                    url: base_url + '/api/cities/' + state_code,
                    cache: false,
                    error: function(err) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Maaf, terjadi kesalahan, silahkan coba lagi!',
                            type: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            confirmButtonClass: "btn btn-primary py-3 px-6"
                        });
                    },
                    success: function(response){
                        const cities = response.data;
                        var option = '<option value="" default>:: Pilih Kota/kabupaten</option>';
                        if (response.success == true) {
                            for (var i = 0; i < cities.length; i ++) {
                                option += '<option value="' + cities[i].city_code + '">' +cities[i].city_name.toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()) + '</option>';
                            }
                            $('.cities').append(option);
                        }
                    }
                });
            }
        });
    </script>

@endsection
