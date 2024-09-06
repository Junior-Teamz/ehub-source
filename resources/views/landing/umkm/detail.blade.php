@extends('landing.layouts.app')
@section('extra-title') Detail Kolaborator @endsection
@section('content')
    <hr class="max-md:hidden"/>
    <div class="flex flex-col mt-6 w-full">
        <div class="flex md:items-center items-start mb-4 max-tablet-a51:hidden">
            <a href="{{ route('home.index') }}" class="text-sm font-normal text-gray-500 mr-1">Home</a>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <a href="{{ route('umkm.index') }}" class="text-sm font-normal text-gray-500 mx-1">Kolaborator</a>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <a href="#" class="text-sm font-normal text-gray-800 ml-1">{{ $collaborator->name }}</a>
        </div>

        <div class="relative">
            <img class="w-full h-[255px] object-cover rounded-2xl" src="{{ $collaborator->cover_url ? $collaborator->cover_url : asset('images/ehub-cover.png') }}" />
            <div class="flex flex-row gap-3 absolute left-0 -bottom-14 px-5">
                <div class="w-24 h-24 bg-white rounded-2xl shadow-xl p-2">
                    <img class="w-full h-full object-contain rounded-2xl" src="{{ $collaborator->logo_url }}" />
                </div>
                <div class="flex flex-col justify-end ">
                    <div class="font-bold line-clamp-1">{{ $collaborator->name }}</div>
                    <span class="text-sm text-[#6B7280] line-clamp-1">{{ $collaborator->hasCity->city_name }}</span>
                </div>
            </div>
        </div>
        <div class="flex gap-2 text-white text-sm pt-20 pb-4">
            @foreach ($collaborator->hasTags as $tags_key => $tags)
                @if($tags_key < 2 )
                    <span class="bg-secondary px-2 py-1 rounded-lg">{{ $tags->name }}</span>
                @endif
            @endforeach
            </div>
        <p class="text-[#4B5563] px-5">{!! $collaborator->description !!}</p>

        <div class="flex">
            <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'workshops']) }}" class="flex items-center gap-2 py-5 z-30 cursor-pointer tab hover:border-b-2 hover:border-primary {{ request()->input('type') === 'workshops' ? 'border-b-2 border-primary text-primary' : '' }}">
                <span class="tablinks font-normal">Program</span>
                <p class="text-xs font-medium px-3 py-1 bg-gray-100 rounded-2xl">{{ $count->workshops }}</p>
            </a>
            <a href="{{ route('umkm.detail', [$collaborator->slug, 'type' => 'mentors']) }}" class="flex items-center ml-4 gap-2 py-5 tab cursor-pointer hover:border-b-2 hover:border-primary {{ request()->input('type') === 'mentors' ? 'border-b-2 border-primary text-primary' : '' }}">
                <span class="tablinks font-normal">Mentor</span>
                <p class="text-xs font-medium px-3 py-1 bg-gray-100 rounded-2xl">{{ $count->mentors }}</p>
            </a>
        </div>
        <hr class="z-0" />
        <div class="block mt-4">
            @if(request()->input('type') === 'workshops')
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7 gap-y-8 mb-16">
                @forelse($content as $workshop)
                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-2xl">
                        <img class="w-auto h-[411px] object-cover" src="{{ $workshop->thumbnail }}" alt="{{ $workshop->title }}" />
                        <div class="px-6 pt-6 pb-8 flex-1">
                            <div class="flex flex-col h-full justify-between">
                                <div class="flex flex-col items-start">
                                    <div class="flex flex-row items-center gap-2">
                                        <img class="w-auto h-8 object-contain" src="{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->logo_url : asset('images/logo-ehub-new.png') }}" alt="Logo {{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}" />
                                        <span>{{ $workshop->hasCollaborators->isNotEmpty() ? $workshop->hasCollaborators->first()->name : 'EntrepeneurHub' }}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-3 py-4">
                                        @foreach($workshop->hasTags as $tag)
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="font-bold text-xl mb-2">{{ $workshop->title }}</h4>
                                </div>
                                <div>
                                    <div class="flex flex-row items-center gap-2 mb-6 text-sm">
                                        <ion-icon name="calendar-outline" class="text-[#9CA3AF]"></ion-icon>
                                        <span class="text-[#9CA3AF]">{{ format_date($workshop->start_date, 'D MMMM Y') . ' | ' . format_date($workshop->start_time, 'HH:mm') . ' - ' . format_date($workshop->end_time, 'HH:mm') }} WIB</span>
                                    </div>
                                    <a href="{{ route('workshops.detail', $workshop->slug) }}" class="btn btn-lg btn-primary btn-block">Lihat Program</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-5">
                        Belum terdapat program
                    </div>
                @endforelse
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7 gap-y-8 mb-16">
                @forelse($content as $mentor_key => $mentor)
                    <div class="flex flex-row gap-x-4 md:gap-x-6 p-4 md:p-6 rounded-2xl shadow-xl w-full max-h-[356px]">
                        <div class="flex w-6/12">
                            <img class="w-full h-[280px] md:h-[300px] object-cover rounded mentor-photo-{{ $mentor_key }}" src="{{ $mentor->avatar_url ?? asset('images/avatar-boy.png') }}" onerror="this.src='{{ $mentor->gender == 'male' ? asset('images/avatar-boy.png') : asset('images/avatar-girl.png') }}'" />
                        </div>
                        <div class="flex flex-col w-6/12 max-h-[356px] gap-y-3 md:gap-y-4">
                            <div class="flex flex-row gap-2">
                                <img class="w-8 h-8 object-contain" src="{{ $mentor->hasCollaborator->logo_url }}" alt="{{ $mentor->hasCollaborator->name }}" onerror="this.src='{{ asset('images/news/placeholder.png') }}'"/>
                                <p class="text-xs md:text-sm">{{ $mentor->hasCollaborator->name }}</p>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="font-semibold text-base md:text-lg mentor-fullname-{{ $mentor_key }}">{{ $mentor->fullname }}</h4>
                                <div class="flex gap-1 py-2 flex-wrap text-white text-lg mentor-expertise-{{ $mentor_key }}">
                                    @foreach ($mentor->hasExperts->take(2) as $expert)
                                        <span class="bg-secondary text-xs md:text-sm py-1 px-2 rounded-lg whitespace-nowrap">{{ $expert->name }}</span>
                                    @endforeach
                                </div>
                                <p class="text-[#6B7280] text-xs md:text-sm line-clamp-2 mentor-expertise-{{ $mentor_key }}">{{ $mentor->expertise }}</p>
                            </div>
                            <div class="flex flex-col w-full mt-auto">
                                @auth
                                    @if(is_profile_updated())
                                        <button type="button" onclick="openModal({{ $mentor_key }}, {{ $mentor->id }})" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block open-modal self-end">Konsultasi</button>
                                    @else
                                        <a href="{{ route('profile.edit', ['next_name' => 'mentors']) }}" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}" class="btn text-sm py-2 md:btn-lg md:text-base btn-primary btn-block self-end">Konsultasi</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-5">
                        Belum terdapat mentor
                    </div>
                @endforelse
           </div>
           @endif
        </div>

        @if(!empty($content))
            <div class="flex flex-col py-6 w-full gap-x-8">
                <a href="{{ request()->input('type') === 'workshops' ? route(request()->input('type') . '.index') : '#' }}" class="border border-secondary text-secondary rounded-xl py-3 w-3/4 md:w-1/2 self-center flex flex-row items-center justify-center">
                    <span class="mr-3 text-center text-lg font-sembibold">Lihat Semua</span>
                </a>
            </div>
        @endif
    </div>
@endsection

@section('extra-js')
<script>
    // function for modal consultation
    const modalConsult = document.querySelector('#modalConsultation');
    var overlay = document.querySelector('.overlay');
    var closeModalBtnConsult = document.querySelector('.close-modal');
    var content = document.querySelector('.content');

    function openModal(key, id) {
        let mentorFullname = document.querySelector('.mentor-fullname-' + key).textContent;
        let mentorExpertise = document.querySelector('.mentor-expertise-' + key).textContent;
        let mentorPhoto = document.querySelector('.mentor-photo-' + key).src;
        modalConsult.querySelector('.consultation-mentor-id').value = id;
        modalConsult.querySelector('.consultation-mentor-photo').src = mentorPhoto;
        modalConsult.querySelector('.consultation-mentor-fullname').textContent = mentorFullname;
        modalConsult.querySelector('.consultation-mentor-expertise').textContent = mentorExpertise;
        modalConsult.classList.remove('hidden');
        modalConsult.classList.add('flex');
        modalConsult.classList.add('two');
        content.classList.add('modal-active');
    }
    const closeModal = function () {
        modalConsult.classList.remove('flex');
        content.classList.remove('modal-active');
        modalConsult.classList.add('hidden');
    };
    closeModalBtnConsult.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
</script>
@endsection
