@extends('dashboard.layouts.app')

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <h1 class="text-xl text-gray-800 mb-6">Daftar Peserta Program</h1>
        <div class="flex flex-row items-center w-full mb-8">
            <div class="flex flex-row w-8/12">
                <form class="flex w-full" id="formSearch" method="GET" action="{{ route('dashboard.workshops.participants', $workshop->id) }}">
                    <div class="relative w-6/12">
                        <span class="absolute top-3.5 left-3">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5 16.5L11.5 11.5M13.1667 7.33333C13.1667 10.555 10.555 13.1667 7.33333 13.1667C4.11167 13.1667 1.5 10.555 1.5 7.33333C1.5 4.11167 4.11167 1.5 7.33333 1.5C10.555 1.5 13.1667 4.11167 13.1667 7.33333Z" stroke="#4B5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <input type="text" id="elKeyword" name="keyword" class="py-2.5 pl-10 pr-10 w-full bg-white text-gray-700 rounded-2xl placeholder-gray-700 border border-primary"
                            placeholder="Cari di sini ..." value="{{ $keyword ?? '' }}">
                        <button ype="button" class="absolute top-4 right-3 text-gray-600" onclick="document.getElementById('elKeyword').value=''; document.getElementById('formSearch').submit();">
                            <svg class="fill-current-color w-3 h-3" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1M1 1L13 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-4/12 flex justify-end">
                <a href="{{ route('dashboard.workshops.participants.download', $workshop->id) }}" class="px-6 py-3 bg-primary text-white rounded-xl">Download Data Peserta</a>
            </div>
        </div>
        @if (session()->has('errorExports'))
            <div class="container mb-8" id="alertbox">
                <div class="container bg-white flex items-center text-red-500 border border-red-500 text-sm font-bold px-4 py-2 relative rounded-2xl"
                    role="alert">
                    <div class="flex flex-col my-2">
                        @foreach (session('errorExports') as $error)
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
        <div class="rounded-2xl border bg-gray-100 overflow-auto">
            <table class="border-collapse rounded-2xl min-w-full leading-normal">
                <thead class="rounded-2xl">
                    <tr class="rounded-2xl text-gray-500 font-normal text-md text-left whitespace-nowrap">
                        <th class="py-2.5 px-4">No</th>
                        <th class="py-2.5 px-4">Nama Lengkap</th>
                        <th class="py-2.5 px-4">Email</th>
                        <th class="py-2.5 px-4">Nomor WhatsApp</th>
                        <th class="py-2.5 px-4">Tanggal Permintaan</th>
                        <th class="py-2.5 px-4">Status</th>
                        @role('admin|collaborator|institution')
                        <th class="py-2.5 px-4">Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="rounded-2xl bg-white text-gray-700">
                    @forelse($participants as $key => $participant)
                        <tr>
                            <td class="py-2.5 px-4">
                                {{ $key + $participants->firstItem() }}
                            </td>
                            <td class="py-2.5 px-4">
                                <a href="{{ route('dashboard.entrepreneurs.detail', $participant->user_id) }}" class="text-primary hover:underline">{{ $participant->fullname }}</a>
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $participant->hasUser->email }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $participant->phone_number }}
                            </td>
                            <td class="py-2.5 px-4">
                                {{ $participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first() ? format_date($participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first()->created_at, 'D MMMM Y HH:mm') : '-'  }}
                            </td>
                            <td class="py-2.5 px-4">
                                <span class="badge badge-{{ $participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first()->statusLabel->type }}">
                                    {{ $participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first()->statusLabel->value }}
                                </span>
                            </td>
                            @role('admin|collaborator|institution')
                            <td class="py-2.5 px-4">
                                @if($participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first()->status == 'waiting')
                                <button type="button" class="flex w-6 contact" data-id="{{ $participant->hasWorkshopParticipants->first()->id }}" data-phone="{{ formatWhatsapp($participant->phone_number) }}">
                                    <svg class="w-auto h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="outgoing-call">
                                        <path fill="#1E5163" d="M19.44,13c-.22,0-.45-.07-.67-.12a9.44,9.44,0,0,1-1.31-.39,2,2,0,0,0-2.48,1l-.22.45a12.18,12.18,0,0,1-2.66-2,12.18,12.18,0,0,1-2-2.66L10.52,9a2,2,0,0,0,1-2.48,10.33,10.33,0,0,1-.39-1.31c-.05-.22-.09-.45-.12-.68a3,3,0,0,0-3-2.49h-3a3,3,0,0,0-3,3.41A19,19,0,0,0,18.53,21.91l.38,0a3,3,0,0,0,2-.76,3,3,0,0,0,1-2.25v-3A3,3,0,0,0,19.44,13Zm.5,6a1,1,0,0,1-.34.75,1.06,1.06,0,0,1-.82.25A17,17,0,0,1,4.07,5.22a1.09,1.09,0,0,1,.25-.82,1,1,0,0,1,.75-.34h3a1,1,0,0,1,1,.79q.06.41.15.81a11.12,11.12,0,0,0,.46,1.55l-1.4.65a1,1,0,0,0-.49,1.33,14.49,14.49,0,0,0,7,7,1,1,0,0,0,.76,0,1,1,0,0,0,.57-.52l.62-1.4a13.69,13.69,0,0,0,1.58.46q.4.09.81.15a1,1,0,0,1,.79,1ZM21.86,2.68a1,1,0,0,0-.54-.54,1,1,0,0,0-.38-.08h-4a1,1,0,1,0,0,2h1.58l-3.29,3.3a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l3.3-3.29V7.06a1,1,0,0,0,2,0v-4A1,1,0,0,0,21.86,2.68Z"></path>
                                    </svg>
                                </button>
                                @else
                                -
                                @endif
                            </td>
                            @endrole
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-5 text-center">Belum ada data peserta program yang dapat ditampilkan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!empty($participants))
            <div class="flex justify-end my-4">{{ $participants->links('vendor.pagination.custom') }}</div>
        @endif
    </div>
</div>
@endsection
@section('extra-js')
<script>
    const csrfToken = '{{ csrf_token() }}';
    const statusParticipants = document.querySelectorAll('.contact');

    statusParticipants.forEach((element) => {
        const id = element.dataset.id;
        const phone = element.dataset.phone;

        element.addEventListener('click', () => {
            fetch(`status/${id}?phone=${phone}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .then(function(data) {
                if (data.whatsapp_url) {
                    window.open(data.whatsapp_url, '_blank');
                    window.location.reload();
                } else {
                    console.log('WhatsApp URL not found in response');
                }
            })
            .catch(error => {
                console.log('An error occurred:', error);
            });
        });
    });
</script>
@endsection
