@extends('layouts.main')

@section('container')
    <section class="mt-5">
        <div class="container mt-5">
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2><strong>{{ $post->title }}</strong></h2>
                    <p style="color: grey">{{ $post->created_at->format('l, d F Y') }}</p>
                    <p style="color: grey">By. <a
                            href="/news?author={{ $post->author->username }}">{{ $post->author->name }}</a> in <a
                            href="/news?category={{ $post->category->slug }}"
                            class="label-category">{{ $post->category->name }}</a></p>

                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid"
                            style="max-height: 400px; ">
                    @else
                        <img src="https://source.unsplash.com/450x400?{{ $post->category->name }}" class="img-fluid"
                            alt="{{ $post->category->name }}">
                    @endif

                    <article class="my-3 fs-5" style="color: grey">
                        {!! $post->body !!}
                    </article>
                    <a href="/news">Back to All News</a>
                </div>
            </div>
        </div>
    </section>
@endsection
