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
        <h1 class="text-xl text-gray-800 mb-8">Edit Mentor</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.mentors.update', $mentor->id) }}">
            @csrf
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Mentor <span class="text-red-500">*</span></label>
                <input type="text" name="fullname" placeholder="Nama Mentor" value="{{ old('fullname', $mentor->fullname) }}" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" >
                @error('fullname')
                    <span class="mt-1 text-red-500">Mohon menuliskan nama mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Email </label>
                <input type="email" name="email" placeholder="Email Mentor" value="{{ old('email', $mentor->hasUser ? $mentor->hasUser->email : '') }}"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" >
                @error('email')
                    <span class="mt-1 text-red-500">Mohon menuliskan email mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nomor Telepon </label>
                <input type="number" name="phone_number" placeholder="Nomor Telepon Mentor" value="{{ old('phone_number', $mentor->phone_number) }}"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary">
                @error('phone_number')
                    <span class="mt-1 text-red-500">Mohon menuliskan nomor whatsapp mentor terlebih dahulu!</span>
                @enderror
            </div>
            @role('admin')
            <div class="flex flex-col w-10/12 mb-8">
                <label class="text-gray-600 font-semibold mb-1">Pilih Kolaborator  <span class="text-red-500">*</span></label>
                <select name="collaborator_id" id="collaborator" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" style="width: 100%">
                    <option data-placeholder="true"></option>
                    @foreach ($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}" {{ old('collaborator_id', $mentor->collaborator_id ) == $collaborator->id ? 'selected' : '' }}>{{ $collaborator->name ?? '' }}</option>
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
                        <input type="radio" name="gender" id="male" value="male" {{ old('gender', $mentor->gender) == 'male' ? 'checked' : ''}}
                            class="p-3 border border-gray-200">
                        <label for="male" class="text-gray-600">Laki Laki</label>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <input type="radio" name="gender" id="female" value="female" {{ old('gender', $mentor->gender) == 'female' ? 'checked' : ''}}
                            class="p-3 border border-gray-200">
                        <label for="female" class="text-gray-600">Perempuan</label>
                    </div>
                </div>
                @error('gender')
                        <span class="mt-1 text-red-500">Mohon memilih jenis kelamin mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Profesi / Jabatan / Keahlian  <span class="text-red-500">*</span></label>
                <input type="text" name="expertise" placeholder="Profesi / Jabatan / Keahlian Mentor" value="{{ old('expertise', $mentor->expertise) }}"
                    class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" >
                @error('expertise')
                    <span class="mt-1 text-red-500">Mohon menuliskan profesi / jabatan / keahlian mentor terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Bidang <span class="text-red-500">*</span></label>
                <select name="expert_id[]" id="expert" multiple="multiple" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                    <option data-placeholder="true"></option>
                    @php
                        $mentorExpertId = 0;
                    @endphp
                    @foreach ($experts as $expert)
                        @foreach ($mentor->hasExperts as $mentorExpert)
                            @if ($mentorExpert->id == $expert->id)
                                @php
                                    $mentorExpertId = $mentorExpert->id;
                                @endphp
                                @break
                            @endif
                        @endforeach
                        <option value="{{ $expert->id }}" {{ old('expert_id', $mentorExpertId) == $expert->id ? 'selected' : '' }}>{{ $expert->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('expert_id')
                    <span class="mt-1 text-red-500">Mohon memilih minimal satu (1) bidang keahlian terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col mb-6">
                <span class="text-gray-600 font-semibold mb-2">Status</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" id="status" value="1" class="sr-only peer" {{ old('status', $mentor->status) == true ? 'checked' : '' }}>
                    <div class="w-20 h-8 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-12 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span id="labelStatus" class="ml-6 {{ $mentor->status_label->value ? 'text-green-600' : 'text-red-600' }}">{{ $mentor->status_label->value }}</span>
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
                            <img id="avatar" src="{{ $mentor->avatar_url ?? asset('images/preview-img.svg') }}" class="w-full max-h-64 object-fill"
                                alt="" />
                        </div>
                    </div>
                </div>
                @error('avatar')
                    <span class="mt-1 text-red-500">Mohon mengunggah avatar / foto profile sesuai dengan kriteria yang telah ditentukan!</span>
                @enderror
            </div>
            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.mentors.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
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
    <script>
        const selectCollaborator = new SlimSelect({
            select: '#collaborator',
            settings: {
                showOptionTooltips: true,
                placeholderText : 'Pilih Kolaborator',
            }
        });

        const slimSelectExpert = new SlimSelect({
            select: '#expert',
            settings: {
                showOptionTooltips: true,
                placeholderText : 'Pilih Bidang Mentor',
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
