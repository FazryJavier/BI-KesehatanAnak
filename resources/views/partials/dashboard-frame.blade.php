@if ($lookerStudio)
    <div class="hc-frame">
        <div class="hc-frame__bar">
            <span class="hc-badge"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard Looker Studio</span>
            <a class="hc-btn hc-btn--secondary" href="{{ $lookerStudio->url }}" target="_blank" rel="noopener noreferrer">
                Buka dashboard penuh <i class="fa fa-external-link" aria-hidden="true"></i>
            </a>
        </div>
        <iframe title="Dashboard data kesehatan dan penyakit anak" src="{{ $lookerStudio->url }}" loading="lazy" allowfullscreen
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
    </div>
@else
    <div class="hc-empty">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        Belum ada visualisasi data.
    </div>
@endif
