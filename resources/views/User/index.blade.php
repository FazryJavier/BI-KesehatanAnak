@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    <section class="hc-hero">
        <div class="hc-container">
            <div class="row">
                <div class="col-lg-6">
                    <span class="hc-eyebrow">Data Kesehatan Anak Jawa Barat</span>
                    <h1>Anak sehat, keluarga tenang.</h1>
                    <p class="hc-hero__lead">
                        Meningkatkan kesehatan anak-anak Jawa Barat melalui pemantauan gizi, imunisasi,
                        dan analisis data terintegrasi.
                    </p>
                    <div class="hc-hero__actions">
                        <a class="hc-btn hc-btn--primary" href="{{ url('/looker') }}">Lihat Data</a>
                        <a class="hc-btn hc-btn--secondary" href="{{ url('/service') }}">Kenali Penyakit Anak</a>
                    </div>
                </div>
                <div class="col-lg-6 hc-hero__art">
                    <img src="{{ asset('images/slider-img.png') }}" alt="Ilustrasi pemantauan kesehatan anak">
                </div>
            </div>
        </div>
    </section>

    <section class="hc-section" aria-labelledby="diseases-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Edukasi</span>
                <h2 id="diseases-title">Kenali jenis penyakit anak</h2>
                <p class="hc-muted">Kenali tanda-tandanya, cegah sejak dini, dan tahu kapan harus ke fasilitas kesehatan.</p>
            </div>
            @include('partials.disease-cards')
        </div>
    </section>

    <section class="hc-section hc-section--alt" aria-labelledby="news-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Terbaru</span>
                <h2 id="news-title">Kabar terkini</h2>
            </div>
            @if ($newsUpdate)
                <article class="hc-card">
                    <span class="hc-badge hc-badge--sun">{{ $newsUpdate->updated_at->locale('id')->translatedFormat('j F Y') }}</span>
                    <p class="hc-news__body mt-3">{{ $newsUpdate->content }}</p>
                    <a href="{{ url('/kabar') }}">Lihat halaman kabar <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </article>
            @else
                <div class="hc-empty"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Belum ada kabar terkini.</div>
            @endif
        </div>
    </section>

    <section class="hc-section" aria-labelledby="data-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Data</span>
                <h2 id="data-title">Visualisasi data kesehatan anak</h2>
                <p class="hc-muted">Dashboard interaktif dari data kesehatan dan penyakit yang diderita anak.</p>
            </div>
            @include('partials.dashboard-frame')
        </div>
    </section>
@endsection
