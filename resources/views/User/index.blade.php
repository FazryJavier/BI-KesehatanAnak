@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    <section class="hc-hero">
        <div class="hc-container">
            <div class="row">
                <div class="col-lg-6">
                    <span class="hc-eyebrow">Data Kesehatan Anak Jawa Barat</span>
                    <h1>Kenali kesehatan anak lewat data yang terbuka.</h1>
                    <p class="hc-hero__lead">
                        Healthy Care menyajikan dashboard data kesehatan dan penyakit anak, lengkap dengan
                        penjelasan sederhana dan kabar terbaru agar keluarga tahu apa yang perlu dicegah dan diwaspadai.
                    </p>
                    <div class="hc-hero__actions">
                        <a class="hc-btn hc-btn--primary" href="{{ url('/looker') }}">Lihat Dashboard Data</a>
                        <a class="hc-btn hc-btn--secondary" href="{{ url('/service') }}">Kenali Penyakit Anak</a>
                    </div>
                </div>
                <div class="col-lg-6 hc-hero__art">
                    <img src="{{ asset('images/slider-img.png') }}" alt="Ilustrasi pemantauan kesehatan anak">
                </div>
            </div>
        </div>
    </section>

    <section class="hc-section" aria-labelledby="about-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Tentang</span>
                <h2 id="about-title">Apa itu Healthy Care?</h2>
                <p class="hc-muted">
                    Situs informasi yang menghubungkan data kesehatan anak dengan penjelasan yang mudah dipahami.
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="hc-card">
                        <h3><i class="fa fa-bar-chart" aria-hidden="true"></i> Data terpadu</h3>
                        <p>Dashboard interaktif memuat data kesehatan dan penyakit yang diderita anak: gizi, imunisasi, dan jenis penyakit.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="hc-card">
                        <h3><i class="fa fa-book" aria-hidden="true"></i> Mudah dipahami</h3>
                        <p>Setiap penyakit dijelaskan dengan bahasa sehari-hari: gejala, cara mencegah, dan kapan harus ke fasilitas kesehatan.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="hc-card">
                        <h3><i class="fa fa-lock" aria-hidden="true"></i> Aman dan agregat</h3>
                        <p>Data yang ditampilkan bersifat agregat dan tidak memuat identitas anak atau keluarga.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hc-section hc-section--alt" aria-labelledby="diseases-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Edukasi</span>
                <h2 id="diseases-title">Kenali jenis penyakit anak</h2>
                <p class="hc-muted">Kenali tanda-tandanya, cegah sejak dini, dan tahu kapan harus ke fasilitas kesehatan.</p>
            </div>
            @include('partials.disease-cards')
        </div>
    </section>

    <section class="hc-section" aria-labelledby="data-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Data</span>
                <h2 id="data-title">Dashboard data kesehatan anak</h2>
                <p class="hc-muted">
                    Gunakan filter pada dashboard (bila tersedia) untuk melihat data menurut penyakit, wilayah, atau periode.
                    Di ponsel, buka dashboard penuh agar lebih nyaman dibaca.
                </p>
            </div>
            @include('partials.dashboard-frame')
        </div>
    </section>

    <section class="hc-section hc-section--alt" aria-labelledby="news-title">
        <div class="hc-container">
            <div class="hc-section__head">
                <span class="hc-eyebrow">Terbaru</span>
                <h2 id="news-title">Kabar terkini</h2>
            </div>
            @if ($latestNews->isEmpty())
                <div class="hc-empty"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Belum ada kabar terkini.</div>
            @else
                <div class="row">
                    @foreach ($latestNews as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            @include('partials.news-card')
                        </div>
                    @endforeach
                </div>
                <a class="hc-btn hc-btn--secondary" href="{{ url('/kabar') }}">Lihat semua kabar</a>
            @endif
        </div>
    </section>
@endsection
