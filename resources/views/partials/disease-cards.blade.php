<div class="row">
    @foreach (config('diseases') as $disease)
        <div class="col-sm-6 col-lg-3 mb-4">
            <article class="hc-card hc-disease hc-disease--{{ $disease['tone'] }}">
                <span class="hc-disease__icon" aria-hidden="true"><i class="fa {{ $disease['icon'] }}"></i></span>
                <h3>{{ $disease['name'] }}</h3>
                <p>{{ $disease['summary'] }}</p>
                <a href="{{ url('/service') }}#{{ $disease['slug'] }}">
                    Pelajari {{ $disease['name'] }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </a>
            </article>
        </div>
    @endforeach
</div>
