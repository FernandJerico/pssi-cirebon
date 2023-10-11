@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Data Player</h1>
        </div>
        <div class="col-lg-8">
            <form method="POST" action="/dashboard/teams/{{ $teams->slug }}/players/{{ $players->slug }}" class="mb-5"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Player Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" required autofocus value="{{ old('name', $players->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug', $players->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select class="form-select" name="team_id">
                        @foreach ($team_id as $team)
                            @if (old('team_id', $players->team_id) == $team->id)
                                <option value="{{ $team->id }}" selected>{{ $team->team_name }}</option>
                            @else
                                <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="place_birthdate" class="form-label">Place, Birthdate</label>
                    <input type="text" class="form-control @error('place_birthdate') is-invalid @enderror"
                        id="place_birthdate" name="place_birthdate"
                        value="{{ old('place_birthdate', $players->place_birthdate) }}">
                    @error('place_birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <input type="text" class="form-control @error('gender') is-invalid @enderror" id="gender"
                        name="gender" value="{{ old('gender', $players->gender) }}">
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        name="position" value="{{ old('position', $players->position) }}">
                    @error('position')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                        name="status" value="{{ old('status', $players->status) }}">
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Edit</button>
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
    </script>
@endsection
