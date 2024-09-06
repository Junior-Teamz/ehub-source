@extends('dashboard.layouts.app')

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-4">Program</h1>
        <div class="flex flex-row items-center w-full mb-4">
            <div class="flex flex-row w-8/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.workshops.index') }}">
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
            @hasanyrole('admin|collaborator|institution')
            <div class="w-4/12 flex justify-end">
                <a href="{{ route('dashboard.workshops.create') }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Program</a>
            </div>
            @endhasanyrole
        </div>
        <div class="flex flex-row items-center border-b border-gray-300 mb-6">
            <a href="{{ route('dashboard.workshops.index') }}" class="p-4
                {{ $type == 'all' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Semua</a>
            <a href="{{ route('dashboard.workshops.index', ['type' => 'new']) }}"
                class="p-4 {{ $type == 'new' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Terbaru</a>
            <a href="{{ route('dashboard.workshops.index', ['type' => 'ongoing']) }}"
                class="p-4 {{ $type == 'ongoing' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Sedang Berlangsung</a>
            <a href="{{ route('dashboard.workshops.index', ['type' => 'end']) }}"
                class="p-4 {{ $type == 'end' ? 'border-b-4 text-primary font-semibold border-primary scale-110' : ''}}">Berakhir</a>
        </div>
        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4">No</th>
                        <th class="py-2.5 px-4">Nama Program</th>
                        <th class="py-2.5 px-4">Kategori</th>
                        <th class="py-2.5 px-4">Kolaborator</th>
                        <th class="py-2.5 px-4">Tanggal</th>
                        <th class="py-2.5 px-4">Lokasi</th>
                        @hasanyrole('admin|collaborator|institution')
                            <th class="py-2.5 px-4">Status</th>
                            <th class="py-2.5 px-4">Aksi</th>
                        @endhasanyrole
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700">
                    @forelse($workshops as $key =>  $workshop)
                        <tr>
                            <td class="py-2.5 px-4">
                                {{ $key + $workshops->firstItem() }}
                            </td>
                            <td class="py-2.5 px-4">
                                <div class="flex flex-row items-center gap-6 px-2">
                                    <img class="w-16 h-20 object-fill rounded-2xl" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" />
                                    <p class="max-w-xs">{{ $workshop->title }}</p>
                                </div>
                            </td>
                            <td class="py-2.5 px-6">
                                @forelse ($workshop->hasTags as $workshopTag)
                                    <span class="mb-1">{{ $workshopTag->name }}</span><br>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </td>
                            <td class="py-2.5 px-4">
                                @forelse ($workshop->hasCollaborators as $workshopCollaborator)
                                    <span class="mb-1">{{ $workshopCollaborator->name }} </span><br>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </td>
                            <td class="py-2.5 px-4">{{ $workshop->start_date ? format_date($workshop->start_date, 'D MMMM Y HH:mm') : '-' }}</td>
                            <td class="py-2.5 px-4">{{ $workshop->place == 'online' ? 'Online' : ($workshop->hasCity ? $workshop->hasCity->city_name : '-') }}</td>
                            @hasanyrole('admin|collaborator|institution')
                                <td class="py-2.5 px-4">
                                    <span class="badge badge-{{ $workshop->statusLabel->type }}">{{ $workshop->statusLabel->value }}</span>
                                </td>
                                <td class="py-2.5 px-4">
                                    <div class="flex flex-col items-center gap-y-2">
                                        <div class="flex flex-row items-center gap-x-4">
                                            <a href="{{ route('workshops.detail', $workshop->slug) }}" target="_blank"><ion-icon name="eye-outline" class="text-2xl text-primary" title="Lihat"></ion-icon></a>
                                            <a href="{{ route('dashboard.workshops.edit', $workshop->id) }}" class="text-primary" title="Ubah">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 3H3C1.89543 3 1 3.89543 1 5V16C1 17.1046 1.89543 18 3 18H14C15.1046 18 16 17.1046 16 16V11M14.5858 1.58579C15.3668 0.804738 16.6332 0.804738 17.4142 1.58579C18.1953 2.36683 18.1953 3.63316 17.4142 4.41421L8.82842 13H6L6 10.1716L14.5858 1.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="flex flex-row items-center gap-x-4">
                                            <a href="{{ route('dashboard.workshops.participants', $workshop->id) }}" class="text-primary" title="Lihat Peserta">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 2.35418C10.7329 1.52375 11.8053 1 13 1C15.2091 1 17 2.79086 17 5C17 7.20914 15.2091 9 13 9C11.8053 9 10.7329 8.47624 10 7.64582M13 19H1V18C1 14.6863 3.68629 12 7 12C10.3137 12 13 14.6863 13 18V19ZM13 19H19V18C19 14.6863 16.3137 12 13 12C11.9071 12 10.8825 12.2922 10 12.8027M11 5C11 7.20914 9.20914 9 7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                            <form method="POST" class="m-0 flex items-center form-delete-workshop" action="{{ route('dashboard.workshops.delete', $workshop->id) }}">
                                                @csrf
                                                <button type="submit" class="text-primary" title="Hapus">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16 5L15.1327 17.1425C15.0579 18.1891 14.187 19 13.1378 19H4.86224C3.81296 19 2.94208 18.1891 2.86732 17.1425L2 5M7 9V15M11 9V15M12 5V2C12 1.44772 11.5523 1 11 1H7C6.44772 1 6 1.44772 6 2V5M1 5H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endhasanyrole
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-5 text-center">Belum ada data program yang dapat ditampilkan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!empty($workshops))
            <div class="flex justify-end my-4">{{ $workshops->links('vendor.pagination.custom') }}</div>
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
    document.querySelectorAll('.form-delete-workshop').forEach(form => {
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
