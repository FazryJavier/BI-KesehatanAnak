@extends('Admin.Layouts.master')

@section('title')
    Page About Us
@endsection

@section('content')
    <form method="POST" action="/AboutUs" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success">Create</button>
        <a href="/AboutUs" type="button" class="btn btn-secondary">Back</a>
    </form>

    <style>
        .description {
            font-size: 14px;
            color: #888;
        }
    </style>
@endsection