@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Coaches</h1>
        </div>
        <div class="table-responsive col-lg-10">
            <a href="/dashboard/coaches/create" class="btn btn-success mb-3">Add Coach</a>
            <table class="table table-striped table-sm table-responsive" id="datatables">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Coach Name</th>
                        <th scope="col">Club Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coaches as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->team->team_name }}</td>
                            <td>{{ $data->position }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td>
                                <a href="/dashboard/teams/{{ $data->slug }}" class="badge bg-info"><span
                                        data-feather="eye"></span></a>
                                <a href="/dashboard/coaches/{{ $data->slug }}/edit" class="badge bg-warning"><span
                                        data-feather="edit"></span></a>
                                <form action="/dashboard/coaches/{{ $data->slug }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                            data-feather="x-circle"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
