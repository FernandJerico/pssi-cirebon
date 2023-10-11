@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Users</h1>
        </div>
        <div class="table-responsive col-lg-10">
            <a href="/dashboard/manage-users/create" class="btn btn-success mb-3">Add Users</a>
            <table class="table table-striped table-sm table-responsive" id="datatables">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                @switch($data->is_admin)
                                    @case(1)
                                        Admin
                                    @break

                                    @case(0)
                                        Wartawan
                                    @break

                                    @default
                                        nknown Status
                                @endswitch
                            </td>
                            <td>
                                <a href="/dashboard/manage-users/{{ $data->id }}/edit" class="badge bg-warning"><span
                                        data-feather="edit"></span></a>
                                <form action="/dashboard/news/{{ $data->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                            data-feather="x-circle"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
