@extends('dashboard.layouts.app')

@section('extra-css')
    <style>
        .modal-active {
            overflow: hidden;
        }
    </style>

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-8">Wirausaha</h1>
        <div class="flex flex-row items-center justify-between mb-5">
            <div class="flex flex-row w-4/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.entrepreneurs.index') }}">
                    <div class="relative w-full">
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
            <div class="flex flex-row items-center gap-4">
                <button type="button" onclick="openModalEntrepreneur()" class="btn btn-lg btn-outline-primary">Upload Wirausaha</button>
                <a href="{{ route('dashboard.entrepreneurs.create') }}" class="btn btn-lg btn-primary"> Tambah Wirausaha</a>
            </div>
        </div>

        @if (session()->has('errorImports'))
            <div class="container mb-8" id="alertbox">
                <div class="container bg-white flex items-center text-red-500 border border-red-500 text-sm font-bold px-4 py-2 relative rounded-2xl"
                    role="alert">
                    <div class="flex flex-col my-2">
                        @foreach (session('errorImports') as $error)
                            <div class="flex items-start py-2 border-b border-neutral-disabled">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                                </svg>
                                <p>Terdapat error pada baris ke-{{ $error['row'] }} : </p>
                                <div class="flex flex-col ml-4">
                                    @foreach ($error['message'] as $key => $message)
                                        <p class="text-red-500 mb-1 font-normal"> - Data pada {{ $message }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="absolute top-0 right-0 px-4 py-3 closealertbutton text-red-500" onclick="document.getElementById('alertbox').style.display = 'none';">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        @if ($errors->has('import_entrepreneur'))
        <div class="container mb-8" id="alertbox">
            <div class="container bg-white flex items-center text-red-500 border border-red-500 text-sm font-bold px-4 py-2 relative rounded-2xl"
                role="alert">
                <div class="flex flex-col my-2">
                   {{ $errors->first('import_entrepreneur') }}
                </div>
                <button type="button" class="absolute top-0 right-0 px-4 py-3 closealertbutton text-red-500" onclick="document.getElementById('alertbox').style.display = 'none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4">No</th>
                        <th class="py-2.5 px-4">Nama</th>
                        <th class="py-2.5 px-4">Email</th>
                        <th class="py-2.5 px-4">Nomor WA</th>
                        <th class="py-2.5 px-4">Kategori</th>
                        @role('admin')
                            <th class="py-2.5 px-4">Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700">
                    @forelse($entrepreneurs as $entrepreneurIndex => $entrepreneur)
                        <tr>
                            <td class="py-2.5 px-4">{{ $entrepreneurs->firstItem() + $entrepreneurIndex }}</td>
                            <td class="py-2.5 px-4">{{ $entrepreneur->fullname }}</td>
                            <td class="py-2.5 px-4">{{ $entrepreneur->email }}</td>
                            <td class="py-2.5 px-4">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->phone_number ?? $entrepeneur->phone) : $entrepreneur->phone }}</td>
                            <td class="py-2.5 px-4">{{ $entrepreneur->getEntrepreneurCategoryAttribute($entrepreneur->id) }}</td>
                            @role('admin|institution')
                                <td class="py-2.5 px-4">
                                    <div class="flex flex-row items-center gap-x-4">
                                        <a href="{{ route('dashboard.entrepreneurs.detail', $entrepreneur->id) }}" class="text-primary">
                                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M2.45825 12C3.73253 7.94288 7.52281 5 12.0004 5C16.4781 5 20.2684 7.94291 21.5426 12C20.2684 16.0571 16.4781 19 12.0005 19C7.52281 19 3.73251 16.0571 2.45825 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('dashboard.entrepreneurs.edit', $entrepreneur->id) }}" class="text-primary">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 3H3C1.89543 3 1 3.89543 1 5V16C1 17.1046 1.89543 18 3 18H14C15.1046 18 16 17.1046 16 16V11M14.5858 1.58579C15.3668 0.804738 16.6332 0.804738 17.4142 1.58579C18.1953 2.36683 18.1953 3.63316 17.4142 4.41421L8.82842 13H6L6 10.1716L14.5858 1.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <form method="POST" class="m-0 flex items-center form-delete-entrepreneur" action="{{ route('dashboard.entrepreneurs.delete', $entrepreneur->id) }}">
                                            @csrf
                                            <button type="submit" class="text-primary">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 5L15.1327 17.1425C15.0579 18.1891 14.187 19 13.1378 19H4.86224C3.81296 19 2.94208 18.1891 2.86732 17.1425L2 5M7 9V15M11 9V15M12 5V2C12 1.44772 11.5523 1 11 1H7C6.44772 1 6 1.44772 6 2V5M1 5H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endrole
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-5 text-center">Belum ada wirausaha terdaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex justify-end my-4">{{ $entrepreneurs->links('vendor.pagination.custom') }}</div>
</div>
@endsection

@section('modal')
<div id="upload-entrepreneurs" class="fixed z-30 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
            <form id="form-entrepreneur-import" action="{{ route('dashboard.entrepreneurs.import') }}" method="POST" class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all align-middle max-w-3xl" enctype="multipart/form-data">
                @csrf
                <div class="modal-header flex flex-row items-center justify-between px-4 py-3 border-b">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 p-2" id="modal-title">
                        Upload Wirausaha
                    </h3>
                    <button id="btn-close-entrepreneur" type="button" onclick="closeModalEntrepreneur()">
                        <svg class="fill-current text-primary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>
                </div>
                <div class="bg-white p-6">
                    <div class="my-2">
                        <div class="flex flex-col mt-2 gap-3">
                            <p>
                                Sebelum upload peserta, kamu perlu unduh format file excel dahulu <a href="{{ asset('download/entrepreneur-format.xlsx') }}" class="text-primary underline font-semibold" download>klik disini</a>
                            </p>
                            <label for="import-file" class="block border border-gray-100 rounded-2xl">
                                <span class="sr-only">Pilih File</span>
                                <input id="import-file" type="file" name="import_entrepreneur" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end bg-gray-100 px-4 py-3">
                    <button type="submit" id="import-button" class="btn btn-primary disabled:opacity-50 disabled:cursor-not-allowed" disabled>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    const $entrepreneurForm = document.querySelector('#form-entrepreneur-import');
    const $entrepreneurModal = document.querySelector('#upload-entrepreneurs');
    const $importFile = document.querySelector('#import-file');
    const $importButton = document.querySelector('#import-button');
    const $closeButton = document.querySelector('#btn-close-entrepreneur');

    function openModalEntrepreneur() {
        $entrepreneurModal.classList.remove('invisible');
    }

    function closeModalEntrepreneur() {
        $entrepreneurModal.classList.add('invisible');
    }

    $importFile.addEventListener('change', () => {
        if ($importFile.files.length > 0) {
            $importButton.disabled = false;
        } else {
            $importButton.disabled = true;
        }
    });

    $importButton.addEventListener('click', () => {
        $entrepreneurForm.submit();

        $importButton.disabled = true;
        $closeButton.style.display = 'none';
    });
</script>
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
    document.querySelectorAll('.form-delete-entrepreneur').forEach(form => {
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
