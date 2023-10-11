@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5 ">
            <div class="col-lg-8 mt-3 ">
                <h2>{{ $news->title }}</h2>
                <a href="/dashboard/news" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all My
                    News</a>
                <a href="/dashboard/news/{{ $news->slug }}/edit" class="btn btn-warning" style="color: white"><span
                        data-feather="edit" style="color: white"></span> Edit</a>
                <form action="/dashboard/news/{{ $news->slug }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span
                            data-feather="x-circle"></span> Delete
                    </button>
                </form>

                @if ($news->image)
                    <div>
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->category->name }}"
                            class="img-fluid mt-3">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $news->category->name }}"
                        alt="{{ $news->category->name }}" class="img-fluid mt-3">
                @endif


                <article class="my-3 fs-5">
                    {!! $news->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection
