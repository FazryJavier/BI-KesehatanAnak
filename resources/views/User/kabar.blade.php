@extends('layouts.public')

@section('title', 'Kabar Terkini')
@section('description', 'Pengumuman, edukasi, kegiatan, dan pembaruan data kesehatan anak dari Healthy Care.')

@section('content')
    <div class="hc-pagehead">
        <div class="hc-container">
            <h1>Kabar terkini</h1>
            <p>Pengumuman, edukasi, kegiatan, dan pembaruan data seputar kesehatan anak.</p>
        </div>
    </div>

    <section class="hc-section">
        <div class="hc-container">
            <nav class="hc-filters" aria-label="Filter kategori">
                <a class="hc-chip {{ $category ? '' : 'is-active' }}" href="{{ url('/kabar') }}">Semua</a>
                @foreach (\App\Enums\NewsCategory::cases() as $option)
                    <a class="hc-chip {{ $category === $option ? 'is-active' : '' }}"
                        href="{{ url('/kabar') }}?kategori={{ $option->value }}">{{ $option->getLabel() }}</a>
                @endforeach
            </nav>

            @if ($news->isEmpty())
                <div class="hc-empty"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Belum ada kabar terkini.</div>
            @else
                <div class="row">
                    @foreach ($news as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            @include('partials.news-card')
                        </div>
                    @endforeach
                </div>
                <div class="hc-pagination">{{ $news->links('pagination::simple-bootstrap-4') }}</div>
            @endif
        </div>
    </section>
@endsection
