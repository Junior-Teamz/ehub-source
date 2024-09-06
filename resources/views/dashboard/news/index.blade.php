@extends('dashboard.layouts.app')

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 font-medium mb-6">Kabar</h1>
        <div class="flex flex-row items-center w-full mb-8">
            <div class="flex flex-row w-8/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.news.index') }}">
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
                <a href="{{ route('dashboard.news.create') }}" class="px-6 py-3 bg-primary text-white rounded-xl">Tambah Kabar</a>
            </div>
        </div>
        <hr/>
        <br/>
        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4 text-center">No</th>
                        <th class="py-2.5 px-4">Judul</th>
                        <th class="py-2.5 px-4">Kategori</th>
                        <th class="py-2.5 px-4">Penulis</th>
                        <th class="py-2.5 px-4">Status</th>
                        <th class="py-2.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700">
                     @php
                        $startNumber = ($news->currentPage() - 1) * $news->perPage() + 1;
                    @endphp
                    @forelse($news as $key => $value)
                        <tr>
                            <td class="py-2.5 px-4 text-center">{{ $startNumber++ }}</td>
                            <td class="py-2.5 px-4">
                                <div class="flex flex-row items-center gap-6">
                                    <img class="rounded-lg h-14 w-20 object-cover" src="{{ $value->url_thumbnail }}" alt="{{ $value->title }}" />
                                    <p class="max-w-xs">{{ $value->title }}</p>
                                </div>
                            </td>
                            <td class="py-2.5 px-4">
                                @forelse ($value->hasTags as $newsTag)
                                    <span class="mb-1">{{ $newsTag->name }}</span><br>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </td>
                            <td class="py-2.5 px-4">
                                <?php
                                $collaboratorName = null;
                                if ($value->hasUser) {
                                    $collaborator = $value->hasUser->hasCollaborator;
                                    if ($collaborator) {
                                        $collaboratorName = $collaborator->name;
                                        $displayedName = (strpos($collaboratorName, 'Admin') === false) ? 'Admin ' . $collaboratorName : $collaboratorName;
                                    } else {
                                        $displayedName = 'Admin Ehub';
                                    }
                                } 
                            ?>
                                {{ $displayedName }}
                            </td>
                            <td class="py-2.5 px-4">
                                <span class="badge badge-{{ $value->status_label->type }}">{{ $value->status_label->value }}</span>
                            </td>
                            <td class="py-2.5 px-4 items-center">
                                <div class="flex gap-x-2 items-center">
                                    <a href="{{ route('news.detail', $value->slug) }}" title="Lihat" target="_blank" type="button"><ion-icon name="eye-outline" class="text-2xl text-primary"></ion-icon></a>
                                    <a href="{{ route('dashboard.news.edit', $value->id) }}" title="Ubah" type="button" class="text-primary text-2xl">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('dashboard.news.destroy', $value->id) }}" method="POST" class="form-delete-news">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus">
                                            <span class="text-primary text-2xl">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-5 text-center">Belum ada kabar yang ditulis</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!empty($news))
            <div class="flex justify-end my-4">{{ $news->links('vendor.pagination.custom') }}</div>
        @endif
    </div>
</div>
@endsection
@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        swal.fire({
            title: 'Sukses',
            icon: 'success',
            text: "{{ session()->get('success') }}",
            type: 'success',
            showCancelButton: false,
            timer: 3000,
        });
    </script>
@endif
@if (session()->has('technical_error'))
<script>
    swal.fire({
        title: 'Error',
        icon: 'error',
        text: "{{ session()->get('error') }}",
        type: 'error',
        showCancelButton: false,
        timer: 3000,
    });
</script>
@endif
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
    document.querySelectorAll('.form-delete-news').forEach(form => {
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
