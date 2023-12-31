@extends('layouts.main')

@section('container')
    <div class="container lg-3">
        <h1 class="mb-5">News Categories</h1>
        <div class="container mb-4">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <a href="/news?category={{ $category->slug }}">
                            <div class="card text-bg-dark">
                                <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img"
                                    alt="{{ $category->name }}">
                                <div class="card-img-overlay d-flex align-items-center p-0">
                                    <h5 class="card-title text-center flex-fill p-4 fs-3"
                                        style="background-color: rgba(0,0,0,0.5)">{{ $category->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
