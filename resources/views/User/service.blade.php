@extends('layouts.public')

@section('title', 'Jenis Penyakit')

@section('content')
    <div class="hc-pagehead">
        <div class="hc-container">
            <h1>Jenis penyakit anak</h1>
            <p>Gejala, pencegahan, dan kapan harus ke fasilitas kesehatan.</p>
        </div>
    </div>

    <section class="hc-section">
        <div class="hc-container">
            @foreach (config('diseases') as $disease)
                <article id="{{ $disease['slug'] }}" class="hc-detail hc-disease--{{ $disease['tone'] }}">
                    <h2>
                        <span class="hc-disease__icon mb-0" aria-hidden="true"><i class="fa {{ $disease['icon'] }}"></i></span>
                        {{ $disease['name'] }}
                    </h2>
                    <p>{{ $disease['summary'] }}</p>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Gejala yang perlu diperhatikan</h3>
                            <ul>
                                @foreach ($disease['symptoms'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3>Cara mencegah</h3>
                            <ul>
                                @foreach ($disease['prevention'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="hc-detail__warn">
                        <strong>Kapan ke fasilitas kesehatan?</strong> {{ $disease['warning'] }}
                    </div>
                </article>
            @endforeach

            <p class="hc-muted hc-small">Informasi ini bersifat edukasi umum dan bukan pengganti konsultasi dengan tenaga kesehatan.</p>
        </div>
    </section>
@endsection
