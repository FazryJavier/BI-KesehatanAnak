@extends('Admin.Layouts.master')

@section('title')
    Dashboard
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
                @if (Auth::user()->level == 'Admin')
                    <a class="btn btn-success" href="/AboutUs/create"> Create </a>
                @endif
            </div>
        </div>
    </div>

    <div class="content">
        <h1>Selamat Datang di Dashboard Healthy Care</h1>
    </div>

    {{-- <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-1">Id</th>
                <th class="col-sm-1">Video</th>
                <th class="col-sm-2">Image</th>
                <th class="col-sm-2">Description</th>
                <th class="col-sm-2">Visi</th>
                <th class="col-sm-2">Misi</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($about as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>Descrip</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->video }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" alt="Image" class="img-fluid mt-3"></td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->visi }}</td>
                    <td>{{ $item->misi }}</td>
                    <td>
                        <form action="/AboutUs/{{ $item->id }}" method="POST">
                            @if (Auth::user()->level == 'Admin')
                                <a href="/AboutUs/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            @endif
                            @if (Auth::user()->level == 'Editor')
                                <a href="/AboutUs/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            @endif
                            @csrf
                            @method('delete')
                            @if (Auth::user()->level == 'Admin')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure want to delete this data?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data is Empty</h1>
            @endforelse
        </tbody>
    </table> --}}
@endsection
