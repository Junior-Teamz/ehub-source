@extends('landing.layouts.app')
@section('extra-title') Unduh Materi @endsection
@section('extra-css')
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
@endsection

@section('page-title')
  <div class="flex justify-center items-center py-10 md:py-14 md:-mx-[76px] bg-[#8AAF4A]">
    <h1 class="text-white">Unduh Materi</h1>
  </div>
@endsection

@section('content')
    <div class="flex flex-row items-center justify-center py-5 md:py-16 w-full" action="{{ route('templates.index') }}" method="GET">
        <form class="flex flex-row items-center w-full md:w-9/12">
            <div class="relative flex flex-1 mr-6">
                <svg class="absolute top-2.5 ml-2 md:ml-4" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_248_3601)">
                        <path d="M21.1665 18.6667H20.1132L19.7399 18.3067C21.3399 16.44 22.1665 13.8933 21.7132 11.1867C21.0865 7.48001 17.9932 4.52001 14.2599 4.06668C8.61986 3.37334 3.87319 8.12001 4.56652 13.76C5.01986 17.4933 7.97986 20.5867 11.6865 21.2133C14.3932 21.6667 16.9399 20.84 18.8065 19.24L19.1665 19.6133V20.6667L24.8332 26.3333C25.3799 26.88 26.2732 26.88 26.8199 26.3333C27.3665 25.7867 27.3665 24.8933 26.8199 24.3467L21.1665 18.6667ZM13.1665 18.6667C9.84652 18.6667 7.16652 15.9867 7.16652 12.6667C7.16652 9.34668 9.84652 6.66668 13.1665 6.66668C16.4865 6.66668 19.1665 9.34668 19.1665 12.6667C19.1665 15.9867 16.4865 18.6667 13.1665 18.6667Z" fill="#4B5563"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_248_3601">
                        <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                        </clipPath>
                    </defs>
                </svg>
                <input type="text" class="rounded-xl border border-gray-400 pl-10 md:pl-16 py-3 placeholder-gray-600 w-full hover:border-gray-600 focus:border-gray-600" name="keyword" placeholder="Cari materi yang ingin anda unduh" value="{{ $keyword }}" />
            </div>
            <button type="submit" class="px-7 py-3 border border-primary bg-primary rounded-xl text-white whitespace-nowrap"><span class="flex md:hidden">Cari</span><span class="hidden md:flex">Cari Materi</span></button>
        </form>
    </div>
    <div class="flex flex-col mt-6 w-full">
        <div class="flex max-w-[calc(100vw-3rem)] overflow-hidden">
            <div class="flex flex-row items-center w-full overflow-x-scroll no-scrollbar">
                <a href="{{ route('templates.index') }}" class="flex items-center  gap-2 py-5 cursor-pointer tab hover:border-b-2 hover:border-primary {{ !isset($category) ? 'border-b-2 border-primary text-primary' : '' }}">
                    <span class="tablinks font-normal whitespace-nowrap">Semua</span>
                </a>
                @foreach ($tags as $tag)
                    <a href="{{ route('templates.index', ['category' => $tag->name]) }}" class="flex items-center ml-4 gap-2 py-5 tab cursor-pointer hover:border-b-2 hover:border-primary {{ isset($category) ? ($category == $tag->name ? 'border-b-2 border-primary text-primary' : '') : '' }}">
                        <span class="tablinks font-normal whitespace-nowrap">{{ $tag->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <hr class="z-0" />
        <div class="block my-8">
            <div class="grid grid-cols-1 gap-7 gap-y-8 mb-16">
                @forelse($templates as $template)
                    <div class="flex flex-col rounded-2xl overflow-hidden shadow-xl">
                        <div class="px-6 pt-6 pb-8 flex-1">
                            <div class="flex flex-col xl:flex-row w-full xl:items-end justify-between gap-x-8">
                                <div class="flex flex-col xl:w-9/12 items-start mb-6 xl:mb-0">
                                    <div class="flex flex-wrap gap-3 py-4">
                                        @foreach($template->hasTags as $tag)
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="font-bold text-xl mb-2">{{ $template->title }}</h4>
                                    <div class="line-clamp-3">
                                        <p class="text-sm">{!! $template->description !!}</p>
                                    </div>
                                </div>
                                <div class="xl:w-3/12">
                                    @auth
                                        @if (is_profile_updated())
                                            <button type="button" onclick="openModal({{ $template->id }})" class="btn btn-lg btn-primary btn-block mt-5 open-modal whitespace-nowrap">Lihat Detail</button>
                                        @else
                                            <a href="{{ route('profile.edit', ['next_name' => 'templates']) }}" class="btn btn-lg btn-primary btn-block mt-5 whitespace-nowrap">Lihat Detail</a>
                                        @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block mt-5 whitespace-nowrap">Lihat Detail</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-5">
                        Belum terdapat materi
                    </div>
                @endforelse
            </div>
            @if (!empty($templates))
                <div class="flex justify-center my-4">{{ $templates->links('vendor.pagination.custom') }}</div>
            @endif
        </div>
    </div>
    <div class="modal fixed w-full h-full top-0 left-0 z-30 hidden items-center justify-center" id="modalDetailTemplate">
        <div class="overlay absolute w-full h-full bg-gray-900 opacity-80"></div>
        <div class="bg-white w-full mx-2 sm:w-10/12 sm:mx-0 -mt-12 md:mt-0 md:w-8/12 lg:w-6/12 xl:w-4/12 rounded-2xl shadow-lg z-50 overflow-y-auto">
            <div class="modal-content flex items-center text-left">
                <form class="flex flex-col w-full justify-center" id="formDownloadTemplate">
                    <input type="hidden" name="template_id" value="">
                    <div class="flex w-full items-start justify-between p-6 gap-2">
                        <div class="flex flex-row whitespace-nowrap items-center flex-wrap gap-2" id="tagTemplate">
                        </div>
                        <button type="button" class="rounded-md hover:shadow-md transition-all close-modal flex mt-2">
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292787 1.29259C0.480314 1.10512 0.734622 0.999806 0.999786 0.999806C1.26495 0.999806 1.51926 1.10512 1.70679 1.29259L5.99979 5.58559L10.2928 1.29259C10.385 1.19708 10.4954 1.1209 10.6174 1.06849C10.7394 1.01608 10.8706 0.988496 11.0034 0.987342C11.1362 0.986189 11.2678 1.01149 11.3907 1.06177C11.5136 1.11205 11.6253 1.18631 11.7192 1.2802C11.8131 1.37409 11.8873 1.48574 11.9376 1.60864C11.9879 1.73154 12.0132 1.86321 12.012 1.99599C12.0109 2.12877 11.9833 2.25999 11.9309 2.382C11.8785 2.504 11.8023 2.61435 11.7068 2.70659L7.41379 6.99959L11.7068 11.2926C11.8889 11.4812 11.9897 11.7338 11.9875 11.996C11.9852 12.2582 11.88 12.509 11.6946 12.6944C11.5092 12.8798 11.2584 12.985 10.9962 12.9873C10.734 12.9895 10.4814 12.8888 10.2928 12.7066L5.99979 8.41359L1.70679 12.7066C1.51818 12.8888 1.26558 12.9895 1.00339 12.9873C0.741188 12.985 0.490376 12.8798 0.304968 12.6944C0.11956 12.509 0.0143906 12.2582 0.0121121 11.996C0.00983372 11.7338 0.110629 11.4812 0.292787 11.2926L4.58579 6.99959L0.292787 2.70659C0.105316 2.51907 0 2.26476 0 1.99959C0 1.73443 0.105316 1.48012 0.292787 1.29259Z" fill="#1F2937"/>
                            </svg>
                        </button>
                    </div>
                    <div class="w-full px-6 pb-6 flex flex-col gap-y-6">
                        <h5 class="text-xl font-bold" id="titleTemplate"></h5>
                        <p class="" id="descriptionTemplate"></p>
                        <a href="#" class="hidden" download target="__blank" id="linkDownload"></a>
                        <button type="submit" class="btn btn-block btn-lg btn-primary" >Unduh</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const modalDetailTemplate = document.getElementById('modalDetailTemplate');
        const overlayTempalate = document.querySelector('.overlay');
        const closeModalBtnTemplate = document.querySelector('.close-modal');
        const contentTemplate = document.querySelector('.content');
        const formDownload = document.getElementById('formDownloadTemplate');
        const btnDownload = document.getElementById('btnDownloadTemplate');

        function openModal(templateId) {
            const modalElement = {
                tagTemplate : document.getElementById('tagTemplate'),
                titleTemplate : document.getElementById('titleTemplate'),
                descriptionTemplate : document.getElementById('descriptionTemplate'),
                linkDownload : document.getElementById('linkDownload')
            }

            fetch(`/templates/${templateId}?isJson=true`)
                .then(function(response) {
                    return response.json();
                })
                .then(function(template) {
                    const dataTemplate = template;
                    const hasTagsTemplate = template.has_tags;
                    let htmlTagsTemplate = ``;
                    hasTagsTemplate.forEach(element => {
                        htmlTagsTemplate += ` <span class="whitespace-nowrap bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">`+ element.name +`</span>`;

                    });
                    modalElement.tagTemplate.innerHTML = htmlTagsTemplate;
                    modalElement.titleTemplate.textContent = template.title;
                    modalElement.descriptionTemplate.innerHTML = template.description;
                    modalElement.linkDownload.href = template.file;
                    formDownload.querySelector('[name="template_id"]').value = template.id;
                    modalDetailTemplate.classList.remove('hidden');
                    modalDetailTemplate.classList.add('flex');
                    contentTemplate.classList.add('modal-active');
                });

        }
        const closeModal = function () {
            modalDetailTemplate.classList.remove('flex');
            contentTemplate.classList.remove('modal-active');
            modalDetailTemplate.classList.add('hidden');
        };
        closeModalBtnTemplate.addEventListener("click", closeModal);
        overlayTempalate.addEventListener("click", closeModal);
        
        formDownload.addEventListener('submit', event => {
            event.preventDefault();
            downloadTemplate();
        });
        
        async function downloadTemplate() {
            const templateId = formDownload.querySelector('[name="template_id"]').value;
            try {
                const responseData = await postDownloadTemplate(templateId);
                
                if (responseData.success) {
                    const templateData = responseData.template;
                    const linkDownload = document.getElementById('linkDownload');
                    linkDownload.click();
                } else {
                    Swal.fire({
                        title : 'Error',
                        icon : 'error',
                        text : responseData.message,
                        showCloseButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#1B58C0',
                    });
                }
            } catch (error) {
                Swal.fire({
                    title : 'Error',
                    icon : 'error',
                    text : 'Terjadi kesalahan teknis, silakan kontak customer service kami',
                    showCloseButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#1B58C0',
                });
            }
        }

        async function postDownloadTemplate(id) {
            const fetchOptions = {
                method : "POST",
                headers : {
                    "Content-Type" : "application/json",
                    "Accept" : "application/json",
                    "X-CSRF-TOKEN" :  "{{ csrf_token() }}",
                }
            };
            const urlPost = `/templates/download/`+id;
            const response = await fetch(urlPost, fetchOptions);
            return response.json();
        }
    </script>
@endsection
