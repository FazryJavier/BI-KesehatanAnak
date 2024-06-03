@extends('Admin.Layouts.master')

@section('title')
    Page Link Looker Studio
@endsection

@section('content')
    <form method="POST" action="/LookerStudio" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="link_looker" class="form-label">Link Looker Studio</label>
            <input type="text" name="link_looker" class="form-control">
        </div>
        @error('link_looker')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success">Create</button>
        <a href="/AboutUs" type="button" class="btn btn-secondary">Back</a>
    </form>

    <style>
        .link_looker {
            font-size: 14px;
            color: #888;
        }
    </style>
@endsection
