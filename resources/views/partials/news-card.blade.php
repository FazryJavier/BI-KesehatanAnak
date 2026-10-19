<article class="hc-card hc-newscard">
    <div class="hc-newscard__meta">
        <span class="hc-badge hc-badge--{{ $item->category->tone() }}">{{ $item->category->getLabel() }}</span>
        <time class="hc-small hc-muted" datetime="{{ $item->published_at->toDateString() }}">{{ $item->published_at->locale('id')->translatedFormat('j F Y') }}</time>
    </div>
    <h3><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></h3>
    <p>{{ $item->summary() }}</p>
    <a class="hc-newscard__more" href="{{ route('news.show', $item->slug) }}">
        Baca selengkapnya <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
    </a>
</article>
