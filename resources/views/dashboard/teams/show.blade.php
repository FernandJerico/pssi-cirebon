@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5 ">
            <div class="col-lg-8 mt-3 ">
                <h2>{{ $teams->team_name }}</h2>
                <a href="/dashboard/teams" class="btn btn-success"><span data-feather="arrow-left"></span> Back to Team
                    Pages</a>
                <a href="/dashboard/teams/{{ $teams->slug }}/edit" class="btn btn-warning" style="color: white"><span
                        data-feather="edit" style="color: white"></span> Edit</a>
                <form action="/dashboard/teams/{{ $teams->slug }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span
                            data-feather="x-circle"></span> Delete
                    </button>
                </form>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="box">
                            @if ($teams->image)
                                <div style="max-width: 150px; overflow:hidden">
                                    <img src="{{ asset('storage/' . $teams->image) }}" alt="{{ $teams->category->name }}"
                                        class="img-fluid mt-3" style="border-radius: 50%">
                                </div>
                            @else
                                <img src="https://source.unsplash.com/1200x400?{{ $teams->category->name }}"
                                    alt="{{ $teams->category->name }}" class="img-fluid mt-3">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="box">
                            <h5>Description: {!! $teams->description !!}</h5>
                            <p>Category Team: {{ $teams->category->name }}</p>
                        </div>
                    </div>
                </div>

                <article class="my-3 fs-5 mb-3">
                    <a href="/dashboard/teams/{{ $teams->slug }}/players/create" class="btn btn-primary"><span
                            data-feather="plus-circle"></span> Add
                        Player</a>
                    <a href="/dashboard/coaches/create" class="btn btn-secondary"><span data-feather="plus-circle"></span>
                        Add
                        Official</a>
                    <h4 class="mb-3 mt-3">List Official Klub: {{ $teams->team_name }}</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coaches as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>{{ $data->phone_number }}</td>
                                    <td>
                                        <a href="/dashboard/teams/{{ $teams->slug }}/players/{{ $data->slug }}/edit"
                                            class="badge bg-warning"><span data-feather="edit"></span></a>
                                        <form action="/dashboard/teams/{{ $teams->slug }}/players/{{ $data->slug }}"
                                            method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure?')"><span
                                                    data-feather="x-circle"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="mb-3 mt-3">List Pemain Klub: {{ $teams->team_name }}</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pemain</th>
                                <th scope="col">Tempat, Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->place_birthdate }}</td>
                                    <td>{{ $data->gender }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="/dashboard/teams/{{ $teams->slug }}/players/{{ $data->slug }}/edit"
                                            class="badge bg-warning"><span data-feather="edit"></span></a>
                                        <form action="/dashboard/teams/{{ $teams->slug }}/players/{{ $data->slug }}"
                                            method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure?')"><span
                                                    data-feather="x-circle"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </article>
            </div>
        </div>
    </div>
@endsection
