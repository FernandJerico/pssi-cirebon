@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Player</h1>
        </div>
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/teams/{{ $teams->slug }}/players" class="mb-5"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Player Name</label>
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
                    <label for="team_id" class="form-label">Team</label>
                    <select class="form-select" name="team_id">
                        @foreach ($team_id as $team)
                            <option value="{{ $team->id }}" selected>{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="place_birthdate" class="form-label">Place, Birthdate</label>
                    <input type="text" class="form-control @error('place_birthdate') is-invalid @enderror"
                        id="place_birthdate" name="place_birthdate" value="{{ old('place_birthdate') }}">
                    @error('place_birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="Kepala Pelatih">Laki-laki</option>
                        <option value="Asisten Pelatih">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">position</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        name="position" value="{{ old('position') }}">
                    @error('position')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                        name="status" value="{{ old('status') }}">
                    @error('status')
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

        document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault()
        })

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
