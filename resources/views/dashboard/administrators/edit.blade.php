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
        <h1 class="text-xl text-gray-800 mb-8">Tambah Administrator Baru</h1>
        <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('dashboard.administrators.update', $user->id) }}">
            @csrf
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nama Administrator <span class="text-red-500">*</span></label>
                <input type="text" name="fullname" placeholder="Nama Administrator" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('fullname', $user->fullname) }}">
                @error('fullname')
                    <span class="mt-1 text-red-500">Mohon menuliskan nama administrator terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-8">
                <label class="text-gray-600 font-semibold mb-1">Pilih Role <span class="text-red-500">*</span></label>
                <select name="role_name" id="role" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" style="width: 100%">
                    <option data-placeholder="true"></option>
                    <option value="institution" {{ old('role_id', $user->roles[0]->name) == 'institution' ? 'selected' : '' }}>Kementerian / Lembaga</option>
                    <option value="collaborator" {{ old('role_name', $user->roles[0]->name) == 'collaborator' ? 'selected' : '' }}>Non Kementerian / Lembaga</option>
                </select>
                @error('role_name')
                    <span class="mt-1 text-red-500">Mohon pilih satu (1) role admin terlebih daulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-8">
                <label class="text-gray-600 font-semibold mb-1">Pilih Kolaborator  <span class="text-red-500">*</span></label>
                <select name="collaborator_id" id="collaborator" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" style="width: 100%">
                    <option data-placeholder="true"></option>
                    @foreach ($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}" {{ old('collaborator_id', ($user->hasCollaborator ? $user->hasCollaborator->id : ($user->hasCreatedBy ? ($user->hasCreatedBy->hasCollaborator ? $user->hasCreatedBy->hasCollaborator->id : '') : ''))) == $collaborator->id ? 'selected' : '' }}>{{ $collaborator->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('collaborator_id')
                    <span class="mt-1 text-red-500">Mohon pilih satu (1) kolaborator terlebih dahulu!</span>
                    <p class="mt-1">Jika kolaborator tidak ditemukan, silakan tambahkan terlebih dahulu di menu kolaborator</p>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" placeholder="Email Administrator" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="mt-1 text-red-500">Mohon menuliskan email terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col w-10/12 mb-4">
                <label class="text-gray-600 font-semibold mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="number" name="phone_number" placeholder="Nomor Telepon Administrator" class="w-full py-2.5 px-3 bg-white rounded-md border border-gray-200 text-gray-800 placeholder-gray-500 focus:ring-primary" value="{{ old('phone_number', $user->phone) }}">
                @error('phone_number')
                    <span class="mt-1 text-red-500">Mohon menuliskan nomor whatsapp terlebih dahulu!</span>
                @enderror
            </div>
            <div class="flex flex-col mb-6">
                <span class="text-gray-600 font-semibold mb-2">Status</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" id="status" value="1" class="sr-only peer" {{ old('is_active', $user->is_active) == true ? 'checked' : '' }}>
                    <div class="w-20 h-8 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-12 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span id="labelStatus" class="ml-6 {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">{{ $user->is_active ? 'Aktif' : 'Tidak Aktif'}}</span>
                </label>
            </div>
            <div class="flex flex-row items-center justify-end pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard.administrators.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Batal</a>
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
        const slimSelectCollaborator = new SlimSelect({
            select: '#collaborator',
            settings: {
                showOptionTooltips: true,
                placeholderText : ':: Pilih Kolaborator'
            }
        });

        const slimSelecrRole = new SlimSelect({
            select: '#role',
            settings: {
                showOptionTooltips: true,
                placeholderText: ':: Pilih Role Administrator'
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
