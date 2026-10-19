@extends('layouts.public')

@section('title', 'Visualisasi Data')

@section('content')
    <div class="hc-pagehead">
        <div class="hc-container">
            <h1>Visualisasi data</h1>
            <p>Data kesehatan dan penyakit yang diderita anak, dalam dashboard interaktif.</p>
        </div>
    </div>

    <section class="hc-section">
        <div class="hc-container">
            @include('partials.dashboard-frame')
        </div>
    </section>
@endsection
