@extends('layouts.public')

@section('title', 'Kabar Terkini')

@section('content')
    <div class="hc-pagehead">
        <div class="hc-container">
            <h1>Kabar terkini</h1>
            <p>Informasi terbaru seputar kesehatan anak.</p>
        </div>
    </div>

    <section class="hc-section">
        <div class="hc-container">
            @if ($newsUpdate)
                <article class="hc-card">
                    <span class="hc-badge hc-badge--sun">{{ $newsUpdate->updated_at->locale('id')->translatedFormat('j F Y') }}</span>
                    <p class="hc-news__body mt-3 mb-0">{{ $newsUpdate->content }}</p>
                </article>
            @else
                <div class="hc-empty"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Belum ada kabar terkini.</div>
            @endif
        </div>
    </section>
@endsection
