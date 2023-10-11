@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Archived Post</h1>
        </div>

        <div class="table-responsive col-lg-9">
            <table class="table table-responsive" id="datatables">
                <caption>List of archived news </caption>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($archivedNews as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->author->name }}</td>
                            <td>{{ $data->category->name }}</td>
                            <td>
                                <a href="/dashboard/news/{{ $data->slug }}"
                                    class="badge bg-success text-decoration-none"><span data-feather="eye"></span>
                                    Detail</a>
                                <form action="{{ route('dashboard.need-approval.approve', $data->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="approve-news badge bg-info text-decoration-none border-0"><span
                                            data-feather="check"></span>
                                        Approve</button>
                                </form>
                                {{-- <a href="/dashboard/news/{{ $data->slug }}/edit"
                                    class="badge bg-warning text-decoration-none"><span data-feather="edit"></span>Edit</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.approve-news').on('click', function(e) {
                e.preventDefault();

                var newsId = $(this).data('news-id');
                var requestMethod = $(this).hasClass('approve-news') ? 'PUT' : 'PATCH';

                $.ajax({
                    url: '/dashboard/need-approval/' + newsId,
                    method: requestMethod,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
