@extends('layouts.main')

@section('container')
    <section class="mt-5">
        <h2 class="mt-5 text-center">EXCO</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 px-5 py-3 d-flex justify-content-center">
            @foreach ($exco as $data)
                <div class="official col">
                    <div class="card">
                        @if ($data->image)
                            <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" class="img-fluid"
                                style="width: 450px; height: 375px;">
                        @else
                            <img src="{{ asset('img/no-image.jpg') }}" class="img-fluid" alt="no-image">
                        @endif
                        <div class="card-body">
                            <h6><strong>{{ $data->name }}</strong></h6>
                            <p class="card-text">{{ $data->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="text-center">Komite Tetap</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4 px-5 py-3 d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="row">
                    <div class="choice-chip-container">
                        <button class="choice-chip active" data-status="keuangan-dan-bisnis">Keuangan Dan Bisnis</button>
                        @foreach ($komtap as $data)
                            <button class="choice-chip"
                                data-status="{{ $data }}">{{ ucwords(str_replace('-', ' ', $data)) }}</button>
                        @endforeach
                    </div>
                    <h2 class="text-center mt-4">Badan Yudisial</h2>
                    <div class="choice-chip-container">
                        @foreach ($yudisial as $data)
                            <button class="choice-chip"
                                data-status="{{ $data }}">{{ ucwords(str_replace('-', ' ', $data)) }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="choice-chip-content mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Data akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <h2 class="text-center">Fasilitas - Fasilitas</h2>
        <div class="row mt-2 g-4 px-5 py-3 d-flex justify-content-center">
            <div class="card-facility">
                <img src="img/bima1.jpg" alt="card-img" class="card-img">
                <div class="card-body">
                    <h1 class="card-title">Stadion Bima</h1>
                    <p class="card-subtitle">Stadion</p>
                    <p class="card-info">Lokasi di Stadion Bima, Sunyaragi, Kesambi, Kota Cirebon.
                    </p>

                    <a href="https://goo.gl/maps/meBChFDbroQ9nEBi7" target="_blank">
                        <button class="card-btn">Lokasi</button>
                    </a>

                </div>
            </div>
            <div class="card-facility">
                <img src="img/bima2.jpg" alt="card-img" class="card-img">
                <div class="card-body">
                    <h1 class="card-title">Lapangan Bima Madya</h1>
                    <p class="card-subtitle">Lapangan</p>
                    <p class="card-info">Lokasi di Jl. Yudhasari II, Sunyaragi, Kesambi, Kota Cirebon.
                    </p>

                    <a href="https://goo.gl/maps/vFozdnqpZfhY97qz8" target="_blank">
                        <button class="card-btn">Lokasi</button>
                    </a>

                </div>
            </div>
            <div class="card-facility">
                <img src="img/korem.jpg" alt="card-img" class="card-img">
                <div class="card-body">
                    <h1 class="card-title">Lapangan Korem Cirebon</h1>
                    <p class="card-subtitle">Lapangan</p>
                    <p class="card-info">Lokasi di Korem 063/Sunan Gunung Jati.
                    </p>

                    <a href="https://goo.gl/maps/8hQXjeNB7yuZGGRK8" target="_blank">
                        <button class="card-btn">Lokasi</button>
                    </a>
                </div>
            </div>
            <div class="card-facility">
                <img src="img/arhanud.jpg" alt="card-img" class="card-img">
                <div class="card-body">
                    <h1 class="card-title">Lapangan Arhanud</h1>
                    <p class="card-subtitle">Lapangan</p>
                    <p class="card-info">Lokasi di Jl. Pilang Raya, Sukapura, Kejaksan, Kota Cirebon.
                    </p>

                    <a href="https://goo.gl/maps/fumWx1Bm2G2ZiFmN9" target="_blank">
                        <button class="card-btn">Lokasi</button>
                    </a>
                </div>
            </div>
            <div class="card-facility">
                <img src="img/ranggajati.jpg" alt="card-img" class="card-img">
                <div class="card-body">
                    <h1 class="card-title">Lapangan Wanacala</h1>
                    <p class="card-subtitle">Lapangan</p>
                    <p class="card-info">Lokasi di Wanacala, Harjamukti, Kota Cirebon.
                    </p>

                    <a href="https://goo.gl/maps/8hQXjeNB7yuZGGRK8" target="_blank">
                        <button class="card-btn">Lokasi</button>
                    </a>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <hr>
        <div class="contact p-3">
            <div class="box-contact">
                <div class="row">
                    <div class="box">
                        <img src="{{ asset('img/logo-pssi-transparan.png') }}" alt="" style="height: 350px;"
                            class="about-img">
                    </div>
                    <div class="box">
                        <h4><strong>PSSI Cirebon</strong></h4>
                        <p>Asosiasi PSSI Kota Cirebon adalah badan pengurus sepak bola di tingkat kota Cirebon yang
                            bertugas mengelola dan mengembangkan sepak bola di wilayah tersebut melalui kompetisi, pembinaan
                            pemain muda, pengembangan klub, dan program-program pengembangan sepak bola lainnya.</p>
                        <h4>Address</h4>
                        <p>
                            Perumahan Sekar Kemuning Regency Blok B 12, kecamatan Kesambi, kota Cirebon, Jawa Barat.
                        </p>
                        <h4>Contacts</h4>
                        <p>
                            <strong>Phone:</strong> (0231) 234 919<br>
                            <strong>Email:</strong> pssikotacirebonnew@gmail.com<br>
                        </p>
                    </div>
                    <div class="box">
                        <h4><strong>Maps</strong></h4>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.243052306685!2d108.5343029752953!3d-6.740178393256113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d962ff998cf%3A0x5b5817b2fa9a549c!2sPerumahan%20Sekar%20Kemuning!5e0!3m2!1sen!2sid!4v1690518671910!5m2!1sen!2sid"
                            width="400" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const choiceChips = document.querySelectorAll('.choice-chip');
            const tableBody = document.getElementById('table-body');

            fetch(`/load-data?status=keuangan-dan-bisnis`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const newRow = document.createElement('tr');
                        const position = item.position.replace(/-/g, ' ').replace(/\b\w/g,
                            char => char.toUpperCase());
                        newRow.innerHTML = `
                                        <td>${item.name}</td>
                                        <td>${position}</td>
                                    `;
                        tableBody.appendChild(newRow);
                    });
                });

            choiceChips.forEach(chip => {
                chip.addEventListener('click', () => {
                    choiceChips.forEach(otherChip => {
                        otherChip.classList.remove('active');
                    });

                    chip.classList.add('active');
                    const selectedStatus = chip.getAttribute('data-status');

                    fetch(`/load-data?status=${selectedStatus}`)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = ''; // Bersihkan isi tabel sebelumnya

                            data.forEach(item => {
                                const newRow = document.createElement('tr');
                                const position = item.position.replace(/-/g, ' ').replace(/\b\w/g,
                                    char => char.toUpperCase());
                                newRow.innerHTML = `
                                        <td>${item.name}</td>
                                        <td>${position}</td>
                                    `;
                                tableBody.appendChild(newRow);
                            });
                        });
                });
            });
        </script>
    </section>
@endsection
