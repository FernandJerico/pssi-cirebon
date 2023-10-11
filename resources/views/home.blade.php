@extends('layouts.main')

@section('container')
    <section>
        <div class="hero" id="home">
            <div class="container" data-aos="fade-up" data-aos-delay="300">
                <div class="box-hero">
                    <div class="box">
                        <h1>Welcome to</h1>
                        <h1 class="animated">
                            PSSI Kota Cirebon.</h1>
                        <p>
                            Asosiasi PSSI Kota Cirebon adalah badan pengurus sepak bola di tingkat kota Cirebon yang
                            bertugas mengelola dan mengembangkan sepak bola di wilayah tersebut melalui kompetisi, pembinaan
                            pemain muda, pengembangan klub, dan program-program pengembangan sepak bola lainnya.
                        </p>
                    </div>
                    <div class="box">
                        <img src="{{ asset('img/logo-pssi-transparan.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-bg-grey p-3">
        <div class="container mt-5" data-aos="fade-up">
            <div class="row news">
                <div class="section-header">
                    <p>Our Latest <a href="/news"><span>News</span></a></p>
                </div>
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-4 mb-3 col-sm-4 mt-3 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="news-content">
                            <div class="news-img">
                                <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.5)"><a
                                        href="/categories/{{ $post->category->slug }}" class="text-white">
                                        {{ $post->category->name }}</a>
                                </div>
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                        class="img-fluid" style="width: 450px; height: 375px;">
                                @else
                                    <img src="https://source.unsplash.com/450x400?{{ $post->category->name }}"
                                        class="img-fluid" alt="{{ $post->category->name }}">
                                @endif
                            </div>
                            <div class="news-info">
                                <h4>{{ $post->title }}</h4>
                                <span>By. <a href="/news?author={{ $post->author->username }}">{{ $post->author->name }}
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
    </section>
    <section>
        <div class="slide-container swiper mt-5" data-aos="fade-up">
            <div class="section-header">
                <p>My <a href="/teams"><span>Clubs</span></a></p>
            </div>
            <p>Football and Futsal <a href="/teams"><span>Club</span></a></p>
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    @foreach ($teams as $team)
                        <div class="card swiper-slide" data-aos="fade-up" data-aos-delay="100">
                            <div class="image-content">
                                <span class="overlay">
                                </span>
                                <div class="card-image">
                                    @if ($team->image)
                                        <img src="{{ asset('storage/' . $team->image) }}"
                                            alt="{{ $team->category->name }}" class="card-img">
                                    @else
                                        <img src="{{ asset('img/no-image.jpg') }}" class="card-img" alt="no-image">
                                    @endif
                                </div>
                            </div>
                            <div class="card-content">
                                <span>Category: <a
                                        href="/teams?category={{ $team->category->slug }}">{{ $team->category->name }}</a></span>
                                <h2 class="name mt-2">{{ $team->team_name }}</h2>
                                <button class="button"><a href="/teams/{{ $team->slug }}">Detail</a></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endsection
