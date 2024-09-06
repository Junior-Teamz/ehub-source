@extends('dashboard.layouts.app')

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-4">Management Logo</h1>
        <div class="flex flex-row items-center w-full mb-4">
            <div class="flex flex-row w-8/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.logos.index') }}">
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
            @if(request()->input('type') !== 'launch' && request()->input('type') !== 'growth')
                <a href="{{ route('dashboard.logos.create', ['type' => 'plan']) }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Logo</a>
            @elseif(request()->input('type') === 'launch')
                 <a href="{{ route('dashboard.logos.create', ['type' => 'launch']) }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Logo</a>
            @elseif(request()->input('type') === 'growth')
                 <a href="{{ route('dashboard.logos.create', ['type' => 'growth']) }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Logo</a>
            @endif
            </div>
        </div>
        <div class="flex flex-row items-center border-b border-gray-300 mb-6">
            <a href="{{ route('dashboard.logos.index', ['type' => 'plan']) }}"
                class="p-4 {{ $type == 'plan' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Rencanakan Usahamu</a>
            <a href="{{ route('dashboard.logos.index', ['type' => 'launch']) }}"
                class="p-4 {{ $type == 'launch' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Buka Usahamu</a>
            <a href="{{ route('dashboard.logos.index', ['type' => 'growth']) }}"
                class="p-4 {{ $type == 'growth' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Kembangkan Usahamu</a>
        </div>
        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4">No</th>
                        <th class="py-2.5 px-4">Logo</th>
                        <th class="py-2.5 px-4">Website</th>
                        <th class="py-2.5 px-4">Section</th>
                        <th class="py-2.5 px-4">Status</th>
                        <th class="py-2.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700"> 
                    @forelse($logos as $key =>  $logo)
                        <tr>
                            <td class="py-2.5 px-4">
                                {{ $key + $logos->firstItem() }}
                            </td>
                            <td class="py-2.5 px-4">
                                <div class="flex flex-row items-center gap-6 px-2">
                                    <img class="w-16 object-fill rounded-2xl" src="{{ $logo->url_logo }}" alt="{{ $logo->logo_name }}" />
                                    <p class="max-w-xs">{{ $logo->logo_name }}</p>
                                </div>
                            </td>
                            <td class="py-2.5 px-4">{{ $logo->website }}</td>
                            <td class="py-2.5 px-4">{{ $logo->hasSection->section_name }}</td>
                            <td class="py-2.5 px-4">
                                <span class="badge badge-{{ $logo->status == 1 ? 'success' : 'warning' }}">
                                    {{ $logo->status == 1 ? "Aktif" : "Tidak Aktif" }}
                                </span>
                            </td>
                            <td class="py-2.5 px-4">
                                    <div class="flex flex-row items-center gap-x-4">
                                        <a href="{{ route('dashboard.logos.edit', $logo->id) }}" title="Ubah" class="text-primary">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 3H3C1.89543 3 1 3.89543 1 5V16C1 17.1046 1.89543 18 3 18H14C15.1046 18 16 17.1046 16 16V11M14.5858 1.58579C15.3668 0.804738 16.6332 0.804738 17.4142 1.58579C18.1953 2.36683 18.1953 3.63316 17.4142 4.41421L8.82842 13H6L6 10.1716L14.5858 1.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                       
                                        <form method="POST" class="m-0 flex items-center form-delete-logo" action="{{ route('dashboard.logos.destroy', $logo->id) }}">
                                            @csrf
                                            <button type="submit" class="text-primary" title="Hapus">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 5L15.1327 17.1425C15.0579 18.1891 14.187 19 13.1378 19H4.86224C3.81296 19 2.94208 18.1891 2.86732 17.1425L2 5M7 9V15M11 9V15M12 5V2C12 1.44772 11.5523 1 11 1H7C6.44772 1 6 1.44772 6 2V5M1 5H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-5 text-center">Belum ada data program yang dapat ditampilkan</td>
                        </tr>
                    @endforelse                       
                </tbody>
            </table>
        </div>
        @if (!empty($logos))
            <div class="flex justify-end my-4">{{ $logos->links('vendor.pagination.custom') }}</div>
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
    document.querySelectorAll('.form-delete-logo').forEach(form => {
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
