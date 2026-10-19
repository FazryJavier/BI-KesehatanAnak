<?php

/*
 | Educational content for the public "Jenis Penyakit" section.
 | Needs review by a health professional before publication (see docs/BRD.md, BR-06).
 | Planned to move to the database and Filament (docs/PRD.md, AD-05).
 */
return [
    [
        'slug' => 'stunting',
        'name' => 'Stunting',
        'tone' => 'sun',
        'icon' => 'fa-arrows-v',
        'summary' => 'Tinggi badan anak tidak sesuai usianya akibat kekurangan gizi dalam waktu lama.',
        'symptoms' => [
            'Tubuh lebih pendek dibandingkan anak seusianya',
            'Pertumbuhan melambat dan berat badan sulit naik',
            'Lebih mudah sakit dan tampak kurang aktif',
        ],
        'prevention' => [
            'ASI eksklusif selama 6 bulan pertama',
            'MPASI bergizi seimbang, termasuk protein hewani',
            'Timbang dan ukur anak rutin di posyandu',
            'Imunisasi lengkap dan lingkungan yang bersih',
        ],
        'warning' => 'Bawa anak ke puskesmas bila tinggi atau berat badannya terus berada di bawah kurva pertumbuhan.',
    ],
    [
        'slug' => 'demam-berdarah',
        'name' => 'Demam Berdarah',
        'tone' => 'coral',
        'icon' => 'fa-bug',
        'summary' => 'Penyakit akibat virus dengue yang ditularkan lewat gigitan nyamuk Aedes aegypti.',
        'symptoms' => [
            'Demam tinggi mendadak selama 2–7 hari',
            'Sakit kepala, nyeri di belakang mata, dan nyeri otot',
            'Bintik merah di kulit, mual, atau muntah',
        ],
        'prevention' => [
            '3M Plus: menguras, menutup, dan mendaur ulang tempat penampung air',
            'Memakai kelambu atau losion antinyamuk',
            'Gerakan bersama membersihkan sarang nyamuk di lingkungan',
        ],
        'warning' => 'Segera ke fasilitas kesehatan bila anak muntah terus-menerus, nyeri perut hebat, mimisan atau gusi berdarah, tampak lemas, atau tangan dan kaki dingin.',
    ],
    [
        'slug' => 'kurang-gizi',
        'name' => 'Kurang Gizi',
        'tone' => 'mint',
        'icon' => 'fa-cutlery',
        'summary' => 'Asupan makanan tidak mencukupi kebutuhan sehingga mengganggu tumbuh kembang anak.',
        'symptoms' => [
            'Berat badan kurang atau tubuh tampak kurus',
            'Mudah lelah, lesu, dan sering sakit',
            'Nafsu makan menurun dan perkembangan terlambat',
        ],
        'prevention' => [
            'Makanan beragam: sumber karbohidrat, protein, sayur, dan buah',
            'Timbang berat badan setiap bulan',
            'Manfaatkan pemberian makanan tambahan dari posyandu',
        ],
        'warning' => 'Konsultasikan ke tenaga kesehatan bila berat badan anak tidak naik dua bulan berturut-turut.',
    ],
    [
        'slug' => 'pneumonia',
        'name' => 'Pneumonia',
        'tone' => 'sky',
        'icon' => 'fa-heartbeat',
        'summary' => 'Radang pada paru-paru yang dapat disebabkan oleh virus, bakteri, atau jamur.',
        'symptoms' => [
            'Batuk disertai demam',
            'Napas cepat atau terlihat sesak',
            'Dinding dada tertarik ke dalam saat bernapas',
        ],
        'prevention' => [
            'Imunisasi lengkap (termasuk PCV, Hib, dan campak)',
            'ASI dan gizi yang baik',
            'Hindari paparan asap rokok dan polusi',
            'Biasakan cuci tangan dengan sabun',
        ],
        'warning' => 'Segera ke fasilitas kesehatan bila anak napas cepat, sesak, atau bibirnya tampak kebiruan.',
    ],
];
