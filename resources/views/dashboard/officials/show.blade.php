@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5 ">
            <div class="col-lg-8 mt-3">
                <h2>Detail Data</h2>
                <a href="/dashboard/officials" class="btn btn-success"><span data-feather="arrow-left"></span> Back</a>
                <a href="/dashboard/officials/{{ $officials->slug }}/edit" class="btn btn-warning" style="color: white"><span
                        data-feather="edit" style="color: white"></span> Edit</a>
                <form action="/dashboard/officials/{{ $officials->slug }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span
                            data-feather="x-circle"></span> Delete
                    </button>
                </form>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="box">
                            <div style="max-width: 150px; overflow:hidden">
                                <img src="{{ asset('storage/' . $officials->image) }}" class="img-fluid mt-3"
                                    style="border-radius: 50%">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="box">
                            <h5>Profile</h5>
                            <h6>Nama Lengkap: {{ $officials->name }}</h6>
                            <h6>Jabatan: {{ $officials->position }}</h6>
                            <h6>Status: {{ $officials->status }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
