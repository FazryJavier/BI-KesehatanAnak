<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Healthy Care: pemantauan gizi, imunisasi, dan data penyakit anak Jawa Barat.')">
    <title>@yield('title', 'Healthy Care') — Data Kesehatan Anak</title>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Healthy Care">
    <meta property="og:title" content="@yield('title', 'Healthy Care') — Data Kesehatan Anak">
    <meta property="og:description" content="@yield('description', 'Healthy Care: pemantauan gizi, imunisasi, dan data penyakit anak Jawa Barat.')">
    <meta property="og:locale" content="id_ID">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/healthy-care.css') }}">
</head>

<body>
    <a class="hc-skip" href="#main">Lewati ke konten</a>

    <header class="hc-header">
        <div class="hc-container">
            <nav class="navbar navbar-expand-lg navbar-light px-0" aria-label="Navigasi utama">
                <a class="hc-brand" href="{{ url('/') }}">
                    <span class="hc-brand__mark" aria-hidden="true"><i class="fa fa-heart"></i></span>
                    Healthy Care
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hcNav"
                    aria-controls="hcNav" aria-expanded="false" aria-label="Buka menu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
                <div class="collapse navbar-collapse" id="hcNav">
                    <ul class="navbar-nav hc-nav ml-auto align-items-lg-center">
                        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('kabar') ? 'active' : '' }}" href="{{ url('/kabar') }}">Kabar Terkini</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('service') ? 'active' : '' }}" href="{{ url('/service') }}">Jenis Penyakit</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('looker') ? 'active' : '' }}" href="{{ url('/looker') }}">Visualisasi Data</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="hc-footer">
        <div class="hc-container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h2>Healthy Care</h2>
                    <p>Meningkatkan kesehatan anak-anak Jawa Barat melalui pemantauan gizi, imunisasi, dan analisis data terintegrasi.</p>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <h2>Jelajahi</h2>
                    <ul>
                        <li><a href="{{ url('/kabar') }}">Kabar Terkini</a></li>
                        <li><a href="{{ url('/service') }}">Jenis Penyakit</a></li>
                        <li><a href="{{ url('/looker') }}">Visualisasi Data</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <h2>Sumber Data</h2>
                    <p>Dashboard Google Looker Studio. Data bersifat agregat dan tidak memuat identitas anak.</p>
                </div>
            </div>
            <p class="hc-footer__note mb-0">
                Informasi di situs ini bukan pengganti konsultasi dengan tenaga kesehatan.
                &copy; {{ date('Y') }} Healthy Care.
                <a href="{{ url('/admin') }}">Masuk pengelola</a>
            </p>
        </div>
    </footer>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>
