@extends('layouts.main')

@section('container')
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        @include('sweetalert::alert')
        <section class="ftco-section mt-5 mb-3">
            <div class="container mb-3 mt-5">
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-lg-3">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Login First</h3>
                            </div>
                        </div>
                        <form action="/login" class="signin-form" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email" required
                                    autofocus value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn-primary submit px-3">Login</button>
                            </div>
                            <div class="text-md-left mb-3">
                                <a href="#">Forgot Password?</a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </section>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

    </body>

    </html>
@endsection
