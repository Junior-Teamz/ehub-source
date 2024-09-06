@extends('dashboard.layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.5.0/slimselect.min.css" integrity="sha512-GvqWM4KWH8mbgWIyvwdH8HgjUbyZTXrCq0sjGij9fDNiXz3vJoy3jCcAaWNekH2rJe4hXVWCJKN+bEW8V7AAEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .ss-main {
            padding: 10px 12px;;
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
        <h1 class="text-xl text-gray-800 mb-8">Detail Wirausaha - {{ $entrepreneur->fullname }}</h1>
        <div class="grid grid-cols-2 gap-8">
            <div class="grid grid-cols-2 bg-[#f8fafc] rounded-2xl p-6 gap-6">
                <div class="flex w-full items-center col-span-full">
                    <h4 class="mr-2 text-xl font-bold">Identitas Diri</h4>
                    <span class="border-t-2 border-gray-200 flex-1"></span>
                </div>
                <div class="flex flex-row gap-6 w-full col-span-full">
                    <div class="w-6/12">
                        <img class="max-w-[180px] max-h-[180px] rounded-2xl" src="{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->avatar_url ?? asset('images/preview-img.svg')) : asset('images/preview-img.svg')}}">
                    </div>
                    <div class="flex flex-col gap-y-6 w-6/12">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-600">Nama Lengkap</span>
                            <p class="text-neutral-900 font-bold">{{ $entrepreneur->fullname }}</p>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-600">Email</span>
                            <p class="text-neutral-900 font-bold">{{ $entrepreneur->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Nomor Telepon / WhatsApp</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->phone_number : $entrepreneur->phone  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Jenis Kelamin</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->gender_label->value : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Tempat Lahir</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? $entrepreneur->hasParticipant->born_place : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Tanggal Lahir</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->born_date ? format_date($entrepreneur->hasParticipant->born_date, 'D MMMM Y') : '-')  : '-'  }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 bg-[#f8fafc] rounded-2xl p-6 gap-6">
                <div class="flex w-full items-center col-span-full">
                    <h4 class="mr-2 text-xl font-bold">Data Usaha</h4>
                    <span class="border-t-2 border-gray-200 flex-1"></span>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Nama / Ide Usaha</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->name : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Jenis Usaha</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? ($entrepreneur->hasParticipant->hasBusiness->hasBusinessType ? $entrepreneur->hasParticipant->hasBusiness->hasBusinessType->name : '-') : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">NIB (Nomor Induk Berusaha)</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->nib : '-') : '-' }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Tahun Pembuatan NIB</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->nib_created_at : '-') : '-'}}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Provinsi</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasState ? $entrepreneur->hasParticipant->hasState->state_name : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Kabupaten / Kota</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasCity ? $entrepreneur->hasParticipant->hasCity->city_name : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Kecamatan</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasSector ? $entrepreneur->hasParticipant->hasSector->sector_name : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Desa / Kelurahan</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasVillage ? $entrepreneur->hasParticipant->hasVillage->village_name : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-1 col-span-full">
                    <span class="text-sm text-gray-600">Alamat</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->address : '-') : '-'  }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 bg-[#f8fafc] rounded-2xl p-6 gap-6">
                <div class="flex w-full items-center col-span-full">
                    <h4 class="mr-2 text-xl font-bold">Data Marketing</h4>
                    <span class="border-t-2 border-gray-200 flex-1"></span>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Akun Instagram</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->ig_account : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Akun Facebook</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->fb_account : '-') : '-'  }}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Akun Tiktok</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->tiktok_account : '-') : '-' }}</p>
                </div>
                <div class="flex flex-col col-start-2">
                    <span class="text-sm text-gray-600">Situs</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->business_site : '-') : '-'}}</p>
                </div>
                <div class="flex flex-col col-start-1">
                    <span class="text-sm text-gray-600">Komunitas</span>
                    <p class="text-neutral-900 font-bold">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->community : '-') : '-'}}</p>
                </div>
                <div class="flex flex-col flex-wrap col-start-2">
                    <span class="text-sm text-gray-600">Platforms</span>
                    <p class="text-neutral-900 font-bold capitalize">{{ $entrepreneur->hasParticipant ? ($entrepreneur->hasParticipant->hasBusiness ? $entrepreneur->hasParticipant->hasBusiness->platforms_label : '-') : '-'  }}</p>
                </div>
            </div>
        </div>
        <div class="flex flex-row items-center mt-8 pt-8 border-t border-gray-200">
            <a href="{{ route('dashboard.entrepreneurs.index') }}" class="btn btn-outline-primary px-6 py-3 mr-6">Kembali</a>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection