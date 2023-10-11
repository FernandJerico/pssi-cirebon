@extends('layouts.main')

@section('container')
    <section class="mt-5 mb-5">
        <h1 class="mb-3 mt-5 text-center">{{ $title }}</h1>
        <div class="col-lg-12 d-flex justify-content-center align-items-center">
            <form action="" style="width: 500px;" name="pssi-crb-contact-form">
                <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                    <strong>Thanks!</strong> Your message has been sent successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter name" name="name"
                        required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                        required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-send btn-send">Send</button>

                <button class="btn btn-send btn-loading d-none" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </form>
        </div>
    </section>
    <script>
        const scriptURL =
            'https://script.google.com/macros/s/AKfycbwieW6M7JDSVK8Z_5IgqdiTcdBeDO126xMFehWYbox63kotEjXEhucqUmWCOkXLXXLp/exec'
        const form = document.forms['pssi-crb-contact-form']
        const btnSend = document.querySelector('.btn-send');
        const btnLoading = document.querySelector('.btn-loading');
        const myAlert = document.querySelector('.alert');

        form.addEventListener('submit', e => {
            e.preventDefault();
            // button loading
            btnLoading.classList.toggle('d-none');
            btnSend.classList.toggle('d-none');
            fetch(scriptURL, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => {
                    btnLoading.classList.toggle('d-none');
                    btnSend.classList.toggle('d-none');
                    myAlert.classList.toggle('d-none');
                    form.reset();
                    console.log('Success!', response);
                })
                .catch(error => console.error('Error!', error.message))
        })
    </script>
@endsection
