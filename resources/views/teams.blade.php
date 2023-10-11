@extends('layouts.main')

@section('container')
    <section class="mt-5">
        <h1 class="mb-3 mt-5 text-center">{{ $title }}</h1>
        <div class="row d-flex justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/teams">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="input-group mb-3 col-sm-12 col-md-12 col-lg-12">
                        <input type="text" class="form-control" placeholder="Search.." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($teams->count())
            <div class="container">
                <div class="slide-container-teams">
                    <div class="slide-content">
                        <div class="card-wrapper row">
                            @foreach ($teams as $team)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-5 d-flex">
                                    <div class="card">
                                        <div class="image-content">
                                            <span class="overlay"></span>
                                            <div class="card-image">
                                                @if ($team->image)
                                                    <img src="{{ asset('storage/' . $team->image) }}"
                                                        alt="{{ $team->category->name }}" class="card-img">
                                                @else
                                                    <img src="{{ asset('img/no-image.jpg') }}" class="card-img"
                                                        alt="no-image">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h2 class="name">{{ $team->team_name }}</h2>
                                            <span>Category Club: <a href="">{{ $team->category->name }}</a></span>
                                            <button class="button mt-3"><a
                                                    href="/teams/{{ $team->slug }}">Detail</a></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center fs-4">No Team found.</p>
        @endif
        <div class="container lg-3 mt-3 d-flex justify-content-end">
            {{ $teams->links() }}
        </div>
    </section>
@endsection
