@extends('layouts.main')

@section('container')
    <section class="mt-4">
        <h1 class="mb-3 mt-5 pl-5 pt-3">{{ $title }}</h1>
        <div class="container mb-5">
            <div class="row">
                <div class="description-team">
                    <h3 class="text-center">Nama Klub: <strong>{{ $team->team_name }}</strong></h3>
                    <div class="image-content">
                        <div class="card-image">
                            @if ($team->image)
                                @if ($team->category->id === 2)
                                    <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->category->name }}"
                                        style="max-height: 100px; max-width: 250px;">
                                @else
                                    <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->category->name }}"
                                        class="card-img">
                                @endif
                            @else
                                <img src="{{ asset('img/no-image.jpg') }}" class="card-img" alt="no-image">
                            @endif

                        </div>
                    </div>
                    <h4>Daftar Pengurus Klub</h4>
                    <table class="table">
                        <caption>Daftar pelatih {{ $team->team_name }}</caption>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coaches as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>{{ $data->phone_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4>Daftar Pemain</h4>
                    <table class="table">
                        <caption>Daftar pemain {{ $team->team_name }}</caption>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col" class="text-center">Tempat, Tanggal Lahir</th>
                                <th scope="col" class="text-center">Jenis Kelamin</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->place_birthdate }}</td>
                                    <td>{{ $data->gender }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="content">
                    <h4>Profil Klub</h4>
                    <article>{!! $team->description !!}</article>
                </div>
            </div>
        </div>
    </section>
@endsection
