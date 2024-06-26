@extends('Admin.Layouts.master')

@section('title')
    Page Info Admin
@endsection

@push('script')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="/InfoAdmin/create"> Create </a>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-2">No</th>
                <th class="col-sm-8">Username</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($infoAdmin as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        <form action="/InfoAdmin/{{ $item->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure want to delete this data?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data is Empty</h1>
            @endforelse
        </tbody>
    </table>
@endsection
