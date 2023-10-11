@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Coach</h1>
        </div>
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/coaches" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Coach Name</label>
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
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Club Name</label>
                    <select class="form-select" name="team_id">
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" selected>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <select class="form-select" name="position">
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Kepala Pelatih">Kepala Pelatih</option>
                        <option value="Asisten Pelatih">Asisten Pelatih</option>
                        <option value="Pelatih Kiper">Pelatih Kiper</option>
                        <option value="Pelatih Kebugaran">Pelatih Kebugaran</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        name="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </main>

    <script>
        const coach = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        coach.addEventListener("keyup", function() {
            let preslug = coach.value;
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
