@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2">Welcome back, {{ auth()->user()->name }}</h2>
        </div>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <span data-feather="chevron-right" class="align-text-bottom">
                    </li>
                    <li>
                        <a href="#" class="active">Home</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="box-info">
            <li>
                <span data-feather="check-square" class=" ic align-text-bottom">
                </span>
                <span>
                    @if (auth()->user()->is_admin)
                        <h3>{{ $totalNews }}</h3>
                        <p>Total News</p>
                    @else
                        <h3>{{ $approvedNews }}</h3>
                        <p>Approved News</p>
                    @endif
                </span>
            </li>
            <li>
                <span data-feather="users" class="ic align-text-bottom">
                </span>
                <span>
                    @if (auth()->user()->is_admin)
                        <h3>{{ $totalOfficials }}</h3>
                        <p>Total Pengurus</p>
                    @else
                        <h3>{{ $onreviewNews }}</h3>
                        <p>On Review News</p>
                    @endif
                </span>
            </li>
            <li>
                <span data-feather="codepen" class="ic align-text-bottom">
                </span>
                <span>
                    @if (auth()->user()->is_admin)
                        <h3>{{ $totalClub }}</h3>
                        <p>Total Klub</p>
                    @else
                        <h3>{{ $archivedNews }}</h3>
                        <p>Archived News</p>
                    @endif
                </span>
            </li>
        </ul>
        <div class="table-data">
            @if (auth()->user()->is_admin)
                <div class="news">
                    <div class="head">
                        <h3>Berita Terbaru</h3>
                        <span data-feather="book-open" class="ic align-text-bottom">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestPosts as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->category->name }}</td>
                                    <td><span class="status approved">
                                            @switch($data->is_approved)
                                                @case(1)
                                                    Approved
                                                @break

                                                @case(0)
                                                    On Review
                                                @break

                                                @case(2)
                                                    Archived
                                                @break

                                                @default
                                                    Unknown Status
                                            @endswitch
                                        </span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="news">
                    <div class="head">
                        <h3>Berita Saya</h3>
                        <span data-feather="book-open" class="ic align-text-bottom">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myNews as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->category->name }}</td>
                                    <td><span
                                            class="status {{ $data->is_approved === 1 ? 'approved' : ($data->is_approved === 0 ? 'on-review' : 'archived') }}">
                                            @if ($data->is_approved === 1)
                                                Approved
                                            @elseif ($data->is_approved === 0)
                                                On Review
                                            @elseif ($data->is_approved === 2)
                                                Archived
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
            <div class="my-news">
                @if (auth()->user()->is_admin)
                    <div class="head">
                        <h3>Berita Saya</h3>
                    </div>
                    <ul class="news-list">
                        @foreach ($myNews as $data)
                            <li
                                class="bx {{ $data->is_approved === 1 ? 'approved' : ($data->is_approved === 0 ? 'on-review' : 'archived') }}">
                                <p>{{ $data->title }}</p>
                                <span data-feather="more-vertical" class="align-text-bottom"></span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="head">
                        <h3>Profil</h3>
                    </div>
                    <p><strong>Username: </strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email: </strong> {{ auth()->user()->email }}</p>
                    <button id="openDialogBtn" class="btn btn-secondary">Change Password</button>
                    <p class="mt-3">
                        <i>
                            <strong>Note Status:</strong>
                            <br>
                            Approved = Berita Sudah di Approve oleh Admin
                            <br>
                            On Review = Berita Sudah Diterima dan Menunggu Approve oleh Admin
                            <br>
                            Archived = Berita Diarsipkan oleh Admin, silakan Contact Admin Untuk Menanyakan kejelasan
                            Berita Anda
                        </i>
                    </p>
                @endif
            </div>
        </div>
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <!-- Your password change form fields here -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div> --}}
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('openDialogBtn').addEventListener('click', function() {
                var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                myModal.show();
            });
        </script>
    </main>
@endsection
