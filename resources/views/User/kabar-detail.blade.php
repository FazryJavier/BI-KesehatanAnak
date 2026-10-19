@extends('layouts.public')

@section('title', $news->title)
@section('description', $news->summary())

@section('content')
    <div class="hc-pagehead">
        <div class="hc-container">
            <nav aria-label="Breadcrumb" class="hc-small mb-2">
                <a href="{{ url('/kabar') }}">Kabar Terkini</a> <span aria-hidden="true">/</span> {{ $news->category->getLabel() }}
            </nav>
            <h1>{{ $news->title }}</h1>
            <p class="hc-newscard__meta">
                <span class="hc-badge hc-badge--{{ $news->category->tone() }}">{{ $news->category->getLabel() }}</span>
                <time datetime="{{ $news->published_at->toDateString() }}">{{ $news->published_at->locale('id')->translatedFormat('j F Y') }}</time>
                @if ($news->author)
                    <span>· Oleh {{ $news->author->username }}</span>
                @endif
            </p>
        </div>
    </div>

    <section class="hc-section">
        <div class="hc-container">
            <article class="hc-prose">
                {!! $news->contentHtml() !!}

                @if ($news->source_name || $news->sourceLink())
                    <p class="hc-muted hc-small mt-4">
                        Sumber:
                        @if ($news->sourceLink())
                            <a href="{{ $news->sourceLink() }}" target="_blank" rel="noopener noreferrer">{{ $news->source_name ?: $news->sourceLink() }}</a>
                        @else
                            {{ $news->source_name }}
                        @endif
                    </p>
                @endif

                <p class="hc-muted hc-small">Informasi ini bukan pengganti konsultasi dengan tenaga kesehatan.</p>
            </article>

            @if ($related->isNotEmpty())
                <h2 class="mt-5">Kabar lainnya</h2>
                <div class="row">
                    @foreach ($related as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            @include('partials.news-card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
