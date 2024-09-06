@extends('dashboard.layouts.app')

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-6">Administrator</h1>
        <div class="flex flex-row items-center w-full mb-8">
            <div class="flex flex-row w-8/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.administrators.index') }}">
                    <div class="relative w-6/12">
                        <span class="absolute top-3.5 left-3">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5 16.5L11.5 11.5M13.1667 7.33333C13.1667 10.555 10.555 13.1667 7.33333 13.1667C4.11167 13.1667 1.5 10.555 1.5 7.33333C1.5 4.11167 4.11167 1.5 7.33333 1.5C10.555 1.5 13.1667 4.11167 13.1667 7.33333Z" stroke="#4B5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <input type="text" id="elKeyword" name="keyword" class="py-2.5 pl-10 pr-6 w-full bg-white text-gray-700 rounded-2xl placeholder-gray-700 border border-primary" 
                            placeholder="Cari di sini ..." value="{{ $keyword ?? '' }}">
                        <button type="button" class="absolute top-4 right-3 text-gray-600" onclick="document.getElementById('elKeyword').value=''; document.getElementById('formSearch').submit();">
                            <svg class="fill-current-color w-3 h-3" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1M1 1L13 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-4/12 flex justify-end">
                <a href="{{ route('dashboard.administrators.create') }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Administrator</a>
            </div>
        </div>
        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4">No</th>
                        <th class="py-2.5 px-4">Nama</th>
                        <th class="py-2.5 px-4">Instansi</th>
                        <th class="py-2.5 px-4">Email</th>
                        <th class="py-2.5 px-4">Nomor WhatsApp</th>
                        <th class="py-2.5 px-4 w-1/12">Status</th>
                        @role('admin')
                            <th class="py-2.5 px-4">Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700">
                    @forelse($administrators as $key => $administrator)
                        <tr>
                            <td class="py-2.5 px-4">
                                {{ $key + $administrators->firstItem() }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $administrator->fullname }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $administrator->hasCollaborator ? $administrator->hasCollaborator->name : ( $administrator->hasCreatedBy ? $administrator->hasCreatedBy->fullname : '-') }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $administrator->email }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $administrator->phone }}
                            </td>
                            <td class="py-2.5 px-4 w-1/12">
                                <span class="badge badge-{{ $administrator->activeLabel->type }}">{{ $administrator->activeLabel->value }}</span>
                            </td>
                            @role('admin')
                                <td class="py-2.5 px-4">
                                    <div class="flex flex-row items-center gap-2">
                                        <a href="{{ route('dashboard.administrators.edit', $administrator->id) }}" class="text-primary">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 3H3C1.89543 3 1 3.89543 1 5V16C1 17.1046 1.89543 18 3 18H14C15.1046 18 16 17.1046 16 16V11M14.5858 1.58579C15.3668 0.804738 16.6332 0.804738 17.4142 1.58579C18.1953 2.36683 18.1953 3.63316 17.4142 4.41421L8.82842 13H6L6 10.1716L14.5858 1.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>   
                                        </a>
                                        <form method="POST" class="m-0 flex items-center form-generate-password-administrator" action="{{ route('dashboard.administrators.generate', $administrator->id) }}">
                                            @csrf
                                            <button type="submit" class="text-primary text-2xl">
                                                <ion-icon name="key"></ion-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endrole
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-5 text-center">Belum ada data Administrator yang dapat ditampilkan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!empty($administrators))
            <div class="flex justify-end my-4">{{ $administrators->links('vendor.pagination.custom') }}</div>
        @endif
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
    document.querySelectorAll('.form-active-administrator').forEach(form => {
        var activeAdmin = form.querySelector('input[name="is_active"]').value;
        form.addEventListener('submit', e => {
            e.preventDefault();
            $message = 'Akun admin akan diaktifkan!';
            if (activeAdmin == '0') {
                $message = 'Akun admin akan dinonaktifkan!';
            } 
            alertConfirm('Apakah anda yakin ?', $message).then(function(yes) {
                if (yes) {
                    e.target.submit();
                }
            })  
        });
    });

    document.querySelectorAll('.form-generate-password-administrator').forEach(form => {
        const urlForm = form.action;
        form.addEventListener('submit', event => {
            event.preventDefault();
            
            alertConfirm('Apakah anda yakin ?', 'Kata sandi akun ini akan diperbarui. Akun dengan kata sandi yang lama tidak akan bisa digunakan untuk mengakses sistem ini!').then(function (yes) {
                if(yes) {
                    handleFormGeneratePassword(urlForm);
                }
            });
        });
    });

    async function handleFormGeneratePassword(url) {

        try {
            const responseData = await postFormGeneratePassword(url);
            
            if (responseData.success) {
                const accountData = responseData.data;
                Swal.fire({
                    title : 'Berhasil',
                    icon : 'success',
                    html : 
                    '<center class="w-full">'
                        +'<div class="my-0 mx-auto max-width-[720px]">'
                            +'<div class="text-neutral-900">'
                                +'<p class="mb-3">Kata sandi akun berhasil diperbarui. Berikut ini adalah akses akun (email dan kata sandi) terbaru.</p>'
                                +'<table class="mb-3" border="0" cellpadding="7" cellspacing="0" width="100%">'
                                    +'<tr>'
                                        +'<td>Email</td><td>: </td><td>'+ accountData.email +'</td>'
                                    +'</tr>'
                                    +'<tr>'
                                        +'<td>Password</td><td>: </td>'
                                        +'<td>'
                                            +'<div class="flex flex-row items-center relative">'
                                                +'<input class="p-0 border-none appearance-none ring-0 focus:ring-0 focus:outline-none focus-visible:outline-none" type="text" name="password" value="' +accountData.password+ '" id="password" readonly>'  
                                                +'<button type="button" id="togglePassword" class="text-xl -ml-4" onclick="copyPassword()"><ion-icon name="copy-outline"></ion-icon></button>'
                                                +'<div class="hidden absolute p-1 right-0 bottom-1 bg-neutral-900 rounded-lg text-white text-xs" id="copiedToClipboard"><p class="text-white">Disalin!</p></div>'
                                            +'</div>'
                                        +'</td>'
                                    +'</tr>'
                                +'</table>'
                                +''
                            +'</div>'
                        +'</div>'
                    +'</center>',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,  
                });
            }
            console.log(responseData);
        } catch (error) {
            console.error('Error' + error);
        }
    }

    async function postFormGeneratePassword(url) {
        const fetchOptions = {
            method : "POST",
            headers : {
                "Content-Type" : "application/json",
                "Accept" : "application/json",
                "X-CSRF-TOKEN" :  "{{ csrf_token() }}",
            }
        };

        const response = await fetch(url, fetchOptions);

        return response.json();
    }

    function copyPassword() {
        var copyText = document.querySelector('#password');
        navigator.clipboard.writeText(copyText.value);
        var copiedToClipboard = document.getElementById('copiedToClipboard');
        copiedToClipboard.classList.remove('hidden');
    }
</script>
@endsection