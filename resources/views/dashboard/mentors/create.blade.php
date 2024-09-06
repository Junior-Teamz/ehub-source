@extends('dashboard.layouts.app')

@section('extra-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.css" integrity="sha512-GvqWM4KWH8mbgWIyvwdH8HgjUbyZTXrCq0sjGij9fDNiXz3vJoy3jCcAaWNekH2rJe4hXVWCJKN+bEW8V7AAEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-8">Tambah Mentor Baru</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.mentors.store') }}">
            @csrf
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Mentor <span class="text-red-500">*</span></label>
                <input type="text" name="fullname" placeholder="Nama Mentor" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('fullname') }}">
                @error('fullname')
                    <span class="mt-1 text-red-500">Mohon menuliskan nama mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" placeholder="Email Mentor" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('email') }}">
                @error('email')
                    <span class="mt-1 text-red-500">Mohon menuliskan email terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="number" name="phone_number" placeholder="Nomor Telepon Mentor" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <span class="mt-1 text-red-500">Mohon menuliskan nomor whatsapp mentor terlebih dahulu!</span>
                @enderror
            </div>
            @role('admin')
            <div class="flex flex-col w-10/12 mb-8">
                <label class="text-gray-600 font-semibold mb-1">Pilih Kolaborator  <span class="text-red-500">*</span></label>
                <select name="collaborator_id" id="collaborator" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" style="width: 100%" >
                    <option data-placeholder="true"></option>
                    @foreach ($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}" {{ old('collaborator_id') == $collaborator->id ? 'selected' : '' }}>{{ $collaborator->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('collaborator_id')
                    <span class="mt-1 text-red-500">Mohon memilih satu (1) kolaborator yang terkait terlebih dahulu!</span>
                @enderror
            </div>
            @endrole
            <div class="flex flex-col w-10/12 mb-8">
                <div class="flex flex-row items-center gap-x-4">
                    <span class="text-gray-600 font-semibold mb-1">Jenis Kelamin  <span class="text-red-500">*</span></span>
                    <div class="flex items-center gap-x-2">
                        <input type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : ''}}
                            class="p-3 border border-gray-200">
                        <label for="male" class="text-gray-600">Laki Laki</label>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <input type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : ''}}
                            class="p-3 border border-gray-200">
                        <label for="female" class="text-gray-600">Perempuan</label>
                    </div>
                </div>
                @error('gender')
                        <span class="mt-1 text-red-500">Mohon memilih jenis kelamin terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Profesi / Jabatan / Keahlian  <span class="text-red-500">*</span></label>
                <input type="text" name="expertise" placeholder="Profesi / Jabatan / Keahlian Mentor" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('expertise') }}">
                @error('expertise')
                    <span class="mt-1 text-red-500">Mohon menuliskan profesi / jabatan / keahlian mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Bidang <span class="text-red-500">*</span></label>
                <select name="expert_id[]" multiple="multiple" id="expert" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500 text-gray-600">
                    <option data-placholder="true"></option>
                    @foreach ($experts as $expert)
                        <option value="{{ $expert->id }}" {{ old('expert_id') == $expert->id ? 'selected' : '' }}>{{ $expert->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('expert_id')
                    <span class="mt-1 text-red-500">Mohon memilih minimal satu (1) bidang keahlian terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col mb-6">
                <span class="text-gray-600 font-semibold mb-2">Status</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" id="status" value="1" class="sr-only peer" {{ old('status') == true ? 'checked' : '' }}>
                    <div class="w-20 h-8 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-12 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span id="labelStatus" class="ml-6 text-red-600">Tidak Aktif</span>
                </label>
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-2">Foto Profil Mentor <span class="text-xs font-normal">(Max: 8MB)</span><span class="text-red-500">*</span></label>
                <div class="w-full flex items-start gap-x-8">
                    <div class="flex w-3/12">
                        <label
                            class="border border-primary rounded-lg px-5 py-3 flex items-center cursor-pointer hover:shadow-md">
                            <span class="text-primary mr-2">
                                <svg class="w-4 h-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1V17M17 9L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </span>
                            <p class="text-sm text-gray-800 font-semibold">Upload Gambar</p>
                            <input type="file" name="avatar" onchange="previewAvatar()" class="hidden" accept=".png,.jpg,.jpeg,.svg" />
                        </label>
                    </div>
                    <div class="flex 9/12">
                        <div class="relative flex items-center justify-center">
                            <img id="avatar" src="{{ asset('images/preview-img.svg') }}" class="w-full max-h-64 object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('avatar')
                    <span class="mt-1 text-red-500">Mohon mengunggah avatar / foto profile mentor sesuai dengan kriteria yang telah ditentukan!</span>
                @enderror
            </div>
            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.mentors.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
                <button type="submit" id="submitButton" class="btn btn-primary px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3"])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.js" integrity="sha512-PWzfW6G+AwNx/faHiIF20Q+enGoRndfrJrVc0JGj1y59W6WxkpzCfe0tt34qqK9bCFAXCE/t/O7nzQ8WXnw1vQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const submitButton = document.getElementById('submitButton');
        const form = document.querySelector('form');

        form.addEventListener('submit', (e) => {
            
            submitButton.disabled = true;
        });

        const slimSelectCollaborator = new SlimSelect({
            select: '#collaborator',
            settings: {
                showOptionTooltips: true,
                placeholderText : ':: Pilih Kolaborator'
            }
        });

        const slimSelectExpert = new SlimSelect({
            select: '#expert',
            settings: {
                showOptionTooltips: true,
                placeholderText: ':: Pilih Bidang Mentor'
            }
        });

        function previewAvatar() {
            avatar.src=URL.createObjectURL(event.target.files[0]);
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
    </script>

@endsection
