@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add New</h1>
        </div>
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/officials" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" required autofocus value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Status Komite</label>
                    <select class="form-select" name="position">
                        <option value="Anggota">Anggota</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil-ketua">Wakil Ketua</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Komite</label>
                    <select class="form-select" name="status">
                        <option value="EXCO">EXCO</option>
                        <option value="keuangan-dan-bisnis">Keuangan dan Bisnis</option>
                        <option value="kompetisi">Kompetisi</option>
                        <option value="wasit-teknik-dan-pengembangan">Wasit, Teknik, dan Pengembangan</option>
                        <option value="sepakbola-wanita">Sepakbola Wanita</option>
                        <option value="pengembangan-usia-muda">Pengembangan Usia Muda</option>
                        <option value="futsal">Futsal</option>
                        <option value="sepakbola">Sepakbola</option>
                        <option value="hukum-dan-keamanan">Hukum dan Keamanan</option>
                        <option value="media-dan-promosi">Media dan Promosi</option>
                        <option value="disiplin">Disiplin</option>
                        <option value="etik">Etik</option>
                        <option value="banding">Banding</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </main>

    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        name.addEventListener("keyup", function() {
            let preslug = name.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });

        function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
