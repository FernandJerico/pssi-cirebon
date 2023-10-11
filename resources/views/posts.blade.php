@extends('layouts.main')

@section('container')
    <section class="mt-4">
        <div class="row mb-3 mt-3">
            <div class="px-5 d-flex justify-content-between align-items-center">
                <h1 class="mb-3 mt-5 px-4">{{ $title }}</h1>
                <form action="/news">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="input-group mt-5 mb-3 col-sm-12 col-md-12 col-lg-12">
                        <input type="text" class="form-control" placeholder="Search.." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($posts->count())
            {{-- <div class="container">
                <div class="card mb-4">
                    @if ($posts[0]->image)
                        <div style="max-height: 400px; overflow:hidden;">
                            <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}"
                                class="img-fluid">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top"
                            alt="{{ $posts[0]->category->name }}">
                    @endif

                    <div class="card-body text-center">
                        <h3 class="card-title"><a href="/news/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
                        <p>
                            <small class="text-muted">
                                By. <a
                                    href="/news?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
                                in
                                <a href="/news?category={{ $posts[0]->category->slug }}"
                                    class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                                {{ $posts[0]->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text">{{ $posts[0]->excerpt }}</p>
                        <button><a href="/news/{{ $posts[0]->slug }}">Read More</a></button>

                    </div>
                </div>
            </div> --}}


            <div class="container mt-3">
                <div class="row news">
                    {{-- @foreach ($posts->skip(1) as $post) --}}
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up"
                            data-aos-delay="100">
                            <div class="news-content">
                                <div class="news-img">
                                    <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.5)"><a
                                            href="/categories/{{ $post->category->slug }}" class="text-white">
                                            {{ $post->category->name }}</a>
                                    </div>
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                            class="img-fluid">
                                    @else
                                        <img src="https://source.unsplash.com/450x400?{{ $post->category->name }}"
                                            class="img-fluid" alt="{{ $post->category->name }}">
                                    @endif

                                </div>
                                <div class="news-info">
                                    <h4>{{ $post->title }}</h4>
                                    <span>By. <a
                                            href="/news?author={{ $post->author->username }}">{{ $post->author->name }}
                                        </a> in <a href="/news?category={{ $post->category->slug }}"
                                            class="text-decoration-none">{{ $post->category->name }}</a>
                                        {{ $post->created_at->diffForHumans() }}</span>
                                    <p class="card-text">{{ $post->excerpt }}</p>
                                    <button><a href="/news/{{ $post->slug }}">Read More</a></button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-center fs-4">No Post found.</p>
        @endif
        <div class="container pagination lg-3 d-flex justify-content-end">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
