@extends('dashboard.layouts.app')
@section('extra-css')
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
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
    <div class="justify-center w-full">
        <div class="flex-col bg-white rounded-xl p-8 drop-shadow-lg">
            <h1 class="text-base text-gray-700 font-medium mb-4">Edit Kabar</h1>
            <hr />
            <br />
            <div class="rounded-2xl border bg-gray-100 overflow-auto">
                <form action="{{ route('dashboard.news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
                    class="w-full bg-white px-4 pt-6 pb-8">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 flex gap-x-8 justify-between">
                        <div class="flex flex-col mb-4 gap-2 w-4/12">
                            <label class="text-gray-600 font-semibold mb-2">Cover Kabar
                                <span class="text-xs font-normal">(Max: 8MB, Dimensi:600x400)</span> <span class="text-red-500">*</span></label>
                            <div id="image-preview-placeholder"
                                class="w-full h-[200px] rounded-2xl border-dashed border-2 border-primary bg-gray-300 bg-center bg-cover cursor-pointer"
                                onclick="document.getElementById('image-input').click()">
                                <img id="preview-image" class="w-full h-[195px] object-cover rounded-2xl"
                                    src="{{ $news->url_thumbnail ?? asset('images/news/placeholder.png') }}" alt="Image Placeholder">
                            </div>
                            <input type="file" name="image" id="image-input" style="display: none;"
                                onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 text-sm mt-2">Mohon mengunggah gambar sesuai dengan kriteria yang ditentukan</p>
                            @enderror
                        </div>
                        <div class="flex flex-col flex-1">
                            <div class="flex w-full flex-col mb-4 gap-2">
                                <label class="text-gray-600 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" placeholder="Judul" value="{{ old('title', $news->title) }}"
                                    class="w-full mb-2 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                @error('title')
                                    <p class="text-red-500 text-sm">Mohon menulis judul terlebih dahulu!</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mt-2">
                                <label class="text-gray-600 font-semibold mb-2">Kategori<span class="text-red-500">*</span></label>
                                <div class="flex w-full gap-4">
                                    <select id="selectElement" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" name="tags[]" multiple>
                                        <option data-placeholder="true"></option>
                                        @foreach ($tags as $tag)
                                            <option class="hover:primary" value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tags', $selectedTags)) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tags')
                                    <p class="text-red-500 text-sm mt-2">Mohon pilih minimal satu (1) kategori kabar!</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @role('admin')
                        <div class="flex flex-col mb-4">
                            <label class="text-gray-600 font-semibold mb-2">Kolaborator <span class="text-red-500">*</span></label>
                            <div class="flex w-full gap-4">
                                <select id="collaborator" class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500" name="created_by">
                                    <option data-placeholder="true"></option>
                                    @foreach ($collaborators as $collaborator)
                                        <option value="{{ $collaborator->user_id }}"
                                            {{ old('created_by', $news->created_by) == $collaborator->user_id ? 'selected' : '' }}>
                                            {{ $collaborator->name }}
                                        </option>
                                    @endforeach
                                    <option value="{{ Auth::user()->id }}" {{ old('created_by', $news->created_by) == Auth::user()->id ? 'selected' : ''}}>Admin EntrepreneurHub</option>
                                </select>
                            </div>
                            @error('created_by')
                                <p class="text-red-500 text-sm mt-2">Mohon pilih kolaborator kabar.</p>
                            @enderror
                        </div>
                    @endrole

                    <div class="mb-4 mt-2">
                        <label class="text-gray-600 font-semibold pb-2">Konten <span class="text-red-500">*</span></label>
                        <div id="tinyMCEToolbar"></div>
                        <textarea name="content" id="content"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">{{ old('content', $news->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2">Mohon menulis konten terlebih dahulu!</p>
                        @enderror
                    </div>

                    <div class="mb-4 w-6/12 flex flex-col">
                        <label class="text-gray-600 font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status"
                            class="w-full p-3 bg-white rounded-md border border-gray-200 placeholder-gray-500">
                            <option data-placeholder="true"></option>
                            <option value="unpublish" {{ old('status', $news->status) == 'unpublish' ? 'selected' : '' }}>
                                Draft</option>
                            @hasanyrole('collaborator|admin|institution')
                                <option value="ready" {{ old('status', $news->status) == 'ready' ? 'selected' : '' }}>Ready To
                                    Publish</option>
                            @endhasanyrole
                            @role('admin')
                                <option value="publish" {{ old('status', $news->status) == 'publish' ? 'selected' : '' }}>
                                    Publish</option>
                            @endrole
                            @if (in_array($news->status, ['publish', 'inactive']))
                                <option value="inactive"
                                    {{ old('status', $news->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            @endif
                        </select>
                        @error('status')
                            <span class="mt-1 text-red-500">Mohon pilih status kabar terlebih dahulu!</span>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 gap-2">
                        <a href="{{ route('dashboard.news.index') }}" class="border border-primary text-primary font-semibold py-2 px-4 rounded">Batal</a>
                        <button type="submit" class="btn btn-primary text-white font-semibold py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('extra-js')
    <script>
        const slimSelectTag = new SlimSelect({
            select: '#selectElement',
            settings: {
                placeholderText: 'Pilih Kategori',
            }
        });

        const slimSelectStatus = new SlimSelect({
            select: '#status',
            settings: {
                showOptionTooltips: true,
                placeholderText: 'Pilih Status',
            }
        });

        const slimSelectCollaborator = new SlimSelect({
            select: '#collaborator',
            settings: {
                showOptionTooltips: true,
                placeholderText: 'Pilih Kolaborator',
            }
        });

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewImage = document.getElementById('preview-image');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Tampilkan gambar yang dipilih

                    // Membuat objek gambar dengan dimensi 600x400 piksel
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        const maxWidth = 600;
                        const maxHeight = 400;

                        let width = img.width;
                        let height = img.height;

                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }

                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);
                        previewImage.src = canvas.toDataURL(); // Mengganti gambar dengan dimensi baru
                    };
                };
                reader.readAsDataURL(file);
            } else {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = "{{ asset('images/news/placeholder.png') }}"; // Kembalikan ke gambar placeholder
                previewImage.style.display = 'none'; // Sembunyikan gambar yang dipilih
            }
        }
    </script>

    <script src="https://cdn.tiny.cloud/1/mgnx3lcm1bg1v85bmqfw3ogmz9vjtdxolbcs3pmx800uia9e/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            mobile: {
                theme: 'mobile'
            },
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
        });
    </script>
@endsection
