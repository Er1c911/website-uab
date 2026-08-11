<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentPage['label'] }} - Homeband</title>
    <style>
        :root {
            --bg: #050505;
            --surface: #0f0f0f;
            --surface-soft: #151515;
            --text: #f4f4f4;
            --muted: #b7b7b7;
            --line: #282828;
            --accent: #d90b1c;
            --accent-strong: #ff2c43;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 8% 15%, rgba(217, 11, 28, 0.22), transparent 34%),
                radial-gradient(circle at 88% 6%, rgba(217, 11, 28, 0.14), transparent 30%),
                linear-gradient(145deg, #020202 0%, #121212 100%);
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .hamburger {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            border: 1px solid #3a3a3a;
            background: #101010;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            position: fixed;
            top: 16px;
            right: 16px;
            z-index: 40;
        }

        .hamburger span {
            width: 20px;
            height: 2px;
            border-radius: 2px;
            background: #f0f0f0;
            display: block;
        }

        .main {
            position: relative;
            min-height: calc(100vh - 54px);
        }

        .site-footer {
            border-top: 1px solid #2d2d2d;
            text-align: center;
            padding: 14px 16px;
            color: #c7c7c7;
            font-size: 0.86rem;
            background: rgba(8, 8, 8, 0.9);
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: min(290px, 92vw);
            height: 100vh;
            z-index: 20;
            border-left: 1px solid var(--line);
            padding: 16px;
            background: linear-gradient(180deg, rgba(22, 22, 22, 0.98), rgba(10, 10, 10, 0.98));
            transform: translateX(102%);
            transition: transform 0.24s ease;
            overflow-y: auto;
            backdrop-filter: blur(2px);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .menu-backdrop {
            position: fixed;
            inset: 0;
            z-index: 10;
            background: rgba(0, 0, 0, 0.42);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease;
        }

        .menu-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        .menu-title {
            margin: 0 0 12px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #ff8c98;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .menu {
            display: grid;
            gap: 8px;
        }

        .menu-btn {
            text-decoration: none;
            color: #f3f3f3;
            background: rgba(14, 14, 14, 0.92);
            border: 1px solid #353535;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.92rem;
            font-weight: 700;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .menu-btn:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.2);
        }

        .menu-btn.active {
            border-color: var(--accent-strong);
            background: linear-gradient(135deg, rgba(217, 11, 28, 0.8), rgba(255, 44, 67, 0.7));
            color: #fff;
        }

        .content {
            padding: 84px 24px 24px;
            display: grid;
            gap: 16px;
            align-content: start;
        }

        .beranda-welcome {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            align-content: center;
            text-align: center;
            padding: 0 24px;
        }

        .beranda-stack {
            display: grid;
            justify-items: center;
            gap: 18px;
        }

        .beranda-logo {
            width: min(220px, 48vw);
            height: auto;
            display: block;
            filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.45));
        }

        .beranda-welcome h1 {
            margin: 0;
            max-width: 26ch;
            font-size: clamp(1.5rem, 4vw, 2.8rem);
            line-height: 1.25;
            color: #f8f8f8;
            text-shadow: 0 0 20px rgba(217, 11, 28, 0.18);
        }

        .headline {
            margin: 0;
            font-size: clamp(1.6rem, 4vw, 2.6rem);
            line-height: 1.1;
        }

        .headline-center {
            text-align: center;
        }

        .lead {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
            max-width: 70ch;
        }

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 0.9rem;
            border-radius: 999px;
            background: #25D366;
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.16s ease, box-shadow 0.16s ease, background-color 0.16s ease;
            box-shadow: 0 6px 18px rgba(37, 211, 102, 0.16);
        }

        .whatsapp-btn svg { flex: 0 0 auto; }

        .whatsapp-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 26px rgba(37, 211, 102, 0.22);
            background: #1eb954;
            text-decoration: none;
        }

        .pengurus-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 4px;
            justify-content: center;
        }

        .pengurus-link {
            text-decoration: none;
            border: 1px solid #3a3a3a;
            color: #efefef;
            background: rgba(14, 14, 14, 0.85);
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.88rem;
            font-weight: 700;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .pengurus-link:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.2);
        }

        .pengurus-link.active {
            border-color: var(--accent-strong);
            background: linear-gradient(135deg, rgba(217, 11, 28, 0.8), rgba(255, 44, 67, 0.7));
            color: #fff;
        }

        .profile-card {
            margin-top: 6px;
            width: min(360px, 100%);
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #363636;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(18, 18, 18, 0.95), rgba(10, 10, 10, 0.95));
        }

        .profile-photo-wrap {
            aspect-ratio: 1 / 1;
            background: #121212;
            display: grid;
            place-items: center;
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .profile-photo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 999px;
            border: 1px solid #4a4a4a;
            display: grid;
            place-items: center;
            color: #9f9f9f;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .profile-body {
            padding: 14px;
        }

        .profile-name {
            margin: 0;
            font-size: 1.1rem;
            color: #f5f5f5;
        }

        .profile-position {
            margin: 6px 0 0;
            color: #bfbfbf;
            font-size: 0.9rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .cards-center {
            grid-template-columns: repeat(auto-fit, minmax(260px, 360px));
            justify-content: center;
        }

        .undangan-carousel {
            position: relative;
            width: min(100%, 760px);
            max-width: 760px;
            margin: 0.8rem auto 0;
            overflow: hidden;
        }

        .undangan-carousel-track {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            padding-bottom: 8px;
        }

        .undangan-carousel-track::-webkit-scrollbar {
            height: 8px;
        }

        .undangan-carousel-track::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
        }

        .undangan-image-card {
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto;
            max-width: min(100%, 760px);
            border: 1px solid #2f2f2f;
            border-radius: 14px;
            overflow: hidden;
            background: rgba(8, 8, 8, 0.9);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.16);
            scroll-snap-align: center;
        }

        .undangan-image-card img {
            width: auto;
            max-width: 100%;
            max-height: min(60vh, 420px);
            height: auto;
            display: block;
            object-fit: contain;
            background: #000;
        }

        .undangan-carousel-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .undangan-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            transition: background 0.2s ease;
        }

        .undangan-dot.active {
            background: rgba(255, 255, 255, 0.9);
        }

        .card {
            border: 1px solid #2f2f2f;
            border-radius: 12px;
            padding: 14px;
            background: linear-gradient(180deg, var(--surface-soft), var(--surface));
        }

        .card h2 {
            margin: 0;
            color: var(--accent-strong);
            font-size: 1.1rem;
        }

        .card p {
            margin: 8px 0 0;
            color: #c2c2c2;
            line-height: 1.55;
            font-size: 0.9rem;
        }

        .booklet-card {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-height: 100%;
        }

        .booklet-photo-wrap {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: #111;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .booklet-photo {
            width: auto;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .booklet-photo-placeholder {
            color: #9f9f9f;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .booklet-description {
            margin: 0.8rem 0 0;
            color: #d1d1d1;
            line-height: 1.65;
            font-size: 0.95rem;
        }

        .vinyl-layout {
            display: grid;
            gap: 28px;
            justify-items: center;
            width: min(920px, 100%);
            margin: 0 auto;
        }

        .vinyl-player {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(14, 14, 14, 0.96), rgba(23, 23, 23, 0.98));
            padding: 24px 24px 18px;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.30);
            position: relative;
            overflow: hidden;
        }

        .vinyl-player::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -40px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 44, 67, 0.08);
            filter: blur(24px);
        }

        .vinyl-player-top {
            margin: 0 0 20px;
            color: #d6d6d6;
            font-size: 0.95rem;
            text-align: center;
            letter-spacing: 0.04em;
        }

        .vinyl-player-disc {
            width: 100%;
            max-width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle at 50% 50%, #121212 0%, #0c0c0c 18%, #090909 42%, #020202 100%);
            box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.06),
                        inset 0 0 24px rgba(255, 255, 255, 0.03),
                        0 18px 40px rgba(0, 0, 0, 0.28);
            position: relative;
            display: grid;
            place-items: center;
            transition: transform 0.28s ease, border-color 0.22s ease;
            margin: 0 auto;
        }

        .vinyl-player-disc::before {
            content: '';
            width: 112px;
            height: 112px;
            border-radius: 50%;
            background: radial-gradient(circle at 45% 45%, #463a3a 0%, #191313 44%, #100f10 100%);
            box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.08);
            position: absolute;
        }

        .vinyl-player-disc::after {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ececec;
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.08);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .vinyl-player-disc.active {
            border-color: rgba(255, 44, 67, 0.75);
            transform: scale(1.012);
        }

        .vinyl-player-info {
            margin-top: 22px;
            text-align: center;
            padding: 0 12px;
        }

        .vinyl-player-title {
            margin: 0;
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            letter-spacing: 0.02em;
            color: #ffffff;
            text-shadow: 0 0 25px rgba(255, 255, 255, 0.08);
        }

        .vinyl-player-subtitle {
            margin: 10px 0 0;
            color: #c7c7c7;
            font-size: 1rem;
            line-height: 1.6;
        }

        .vinyl-player-controls {
            margin-top: 26px;
            display: flex;
            justify-content: center;
        }

        .vinyl-player-controls .btn {
            min-width: 170px;
            border-radius: 999px;
            padding: 14px 28px;
            font-size: 0.96rem;
            letter-spacing: 0.02em;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.07), 0 12px 36px rgba(217, 11, 28, 0.22);
        }

        .vinyl-player-controls .btn:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            box-shadow: none;
        }

        .vinyl-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 18px;
            width: 100%;
        }

        .vinyl-card {
            width: 100%;
            min-width: 140px;
            aspect-ratio: 1 / 1;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 40%, #151515 0%, #0b0b0b 30%, #040404 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.03), 0 16px 34px rgba(0, 0, 0, 0.22);
            cursor: grab;
            transition: transform 0.18s ease, box-shadow 0.2s ease;
            display: grid;
            place-items: center;
            position: relative;
            overflow: hidden;
        }

        .vinyl-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
        }

        .vinyl-card:active {
            cursor: grabbing;
            transform: scale(0.98);
        }

        .vinyl-card.dragging {
            opacity: 0.7;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.32);
        }

        .vinyl-card::before {
            content: '';
            position: absolute;
            inset: 10%;
            border-radius: 50%;
            background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.04), transparent 30%);
            pointer-events: none;
        }

        .vinyl-card::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #f4f4f4;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 4px rgba(255,255,255,0.08);
            pointer-events: none;
        }

        .vinyl-card .profile-body {
            position: absolute;
            inset: auto 0 16px;
            padding: 0 14px;
            text-align: center;
            display: grid;
            gap: 6px;
            z-index: 1;
            width: 100%;
            bottom: 10px;
        }

        .vinyl-card .profile-name {
            margin: 0;
            font-size: 1rem;
            color: #f5f5f5;
            line-height: 1.2;
        }

        .vinyl-card .booklet-description {
            margin: 0;
            color: #b8b8b8;
            font-size: 0.85rem;
        }

        .vinyl-image-wrap,
        .vinyl-image,
        .vinyl-image-placeholder {
            display: none;
        }

        .vinyl-card {
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: linear-gradient(180deg, rgba(20, 20, 20, 0.95), rgba(14, 14, 14, 0.98));
            padding: 16px;
            border-radius: 22px;
            cursor: grab;
            transition: transform 0.18s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            display: grid;
            gap: 12px;
            position: relative;
        }

        .vinyl-card:hover {
            border-color: rgba(255, 44, 67, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
        }

        .vinyl-card:active {
            cursor: grabbing;
            transform: scale(0.98);
        }

        .vinyl-card.dragging {
            opacity: 0.65;
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.28);
        }

        .vinyl-image-wrap {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 20px;
            overflow: hidden;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.05), rgba(0,0,0,0.25));
            display: grid;
            place-items: center;
            margin-bottom: 8px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .vinyl-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .vinyl-image-placeholder {
            color: #9f9f9f;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        @media (max-width: 960px) {
            .vinyl-layout {
                grid-template-columns: 1fr;
            }

            .vinyl-player {
                width: 100%;
            }
        }

        .role-list li {
            margin-bottom: 0.45rem;
        }

        .role-heading {
            margin: 0.8rem 0 0.35rem;
            color: #f4f4f4;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .mission-list {
            margin: 10px auto 0;
            padding-left: 1.3rem;
            color: #c2c2c2;
            line-height: 1.7;
            text-align: left;
            max-width: 760px;
        }

        .mission-list li {
            margin-bottom: 0.7rem;
            display: list-item;
            text-align: left;
        }

        .mission-list li::marker {
            color: #f4f4f4;
            font-weight: 600;
        }

        .section-content .section-item h2 {
            text-align: center;
        }

        .section-content .section-item p {
            text-align: center;
            max-width: 760px;
            margin: 0 auto;
        }

        @media (max-width: 820px) {
            .content {
                padding: 20px 16px;
            }

            .cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {
            .hamburger {
                top: 12px;
                right: 12px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .menu-btn {
                font-size: 0.89rem;
            }
        }
    </style>
</head>
<body>
    <button class="hamburger" id="menuToggle" type="button" aria-label="Buka menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <section class="main">
        <button id="menuBackdrop" class="menu-backdrop" type="button" aria-label="Tutup menu"></button>
        <aside class="sidebar" id="sidebarMenu">
            <p class="menu-title">Menu Halaman</p>
            <nav class="menu">
                @foreach ($pages as $slug => $page)
                    @if ($page['showInMenu'] ?? true)
                        <a class="menu-btn {{ $currentSlug === $slug ? 'active' : '' }}" href="{{ route($page['route']) }}">
                            {{ $page['label'] }}
                        </a>
                    @endif
                @endforeach
                <!-- Admin login removed from user menu -->
            </nav>
        </aside>

        @if ($currentSlug === 'beranda')
            <article class="content beranda-welcome" aria-label="beranda">
                <div class="beranda-stack">
                    <img class="beranda-logo" src="{{ asset('logo/logo-homeband.png') }}" alt="Logo Homeband">
                    <h1>Selamat Datang di Website Resmi Unit Aktivitas Band</h1>
                </div>
            </article>
        @else
            <article class="content">
                <h1 class="headline headline-center">{{ $currentPage['title'] }}</h1>

                @if (in_array($currentSlug, ['ketum', 'waketum', 'sekben', 'litbang', 'manajemen-event', 'manajemen-talent', 'produksi', 'rumah-tangga', 'psdm'], true))
                    <nav class="pengurus-nav" aria-label="Navigasi Pengurus">
                        <a class="pengurus-link {{ $currentSlug === 'ketum' ? 'active' : '' }}" href="{{ route('user.ketum') }}">Ketum</a>
                        <a class="pengurus-link {{ $currentSlug === 'waketum' ? 'active' : '' }}" href="{{ route('user.waketum') }}">Waketum</a>
                        <a class="pengurus-link {{ $currentSlug === 'sekben' ? 'active' : '' }}" href="{{ route('user.sekben') }}">Sekben</a>
                        <a class="pengurus-link {{ $currentSlug === 'litbang' ? 'active' : '' }}" href="{{ route('user.litbang') }}">Litbang</a>
                        <a class="pengurus-link {{ $currentSlug === 'manajemen-event' ? 'active' : '' }}" href="{{ route('user.manajemen-event') }}">Manajemen Event</a>
                        <a class="pengurus-link {{ $currentSlug === 'manajemen-talent' ? 'active' : '' }}" href="{{ route('user.manajemen-talent') }}">Manajemen Talent</a>
                        <a class="pengurus-link {{ $currentSlug === 'produksi' ? 'active' : '' }}" href="{{ route('user.produksi') }}">Produksi</a>
                        <a class="pengurus-link {{ $currentSlug === 'rumah-tangga' ? 'active' : '' }}" href="{{ route('user.rumah-tangga') }}">Rumah Tangga</a>
                        <a class="pengurus-link {{ $currentSlug === 'psdm' ? 'active' : '' }}" href="{{ route('user.psdm') }}">PSDM</a>
                    </nav>
                @endif

                @if ($currentSlug === 'visi-misi')
                    <section class="section-content" aria-label="Visi dan Misi">
                        <div class="section-item">
                            <h2>Visi</h2>
                            <p>{{ $currentPage['vision'] ?? '' }}</p>
                        </div>
                        <div class="section-item">
                            <h2>Misi</h2>
                            @php
                                $missionText = trim($currentPage['mission'] ?? '');
                                $missionItems = array_filter(preg_split('/\r\n|\r|\n/', $missionText), fn($line) => trim($line) !== '');
                            @endphp

                            @if (!empty($missionItems))
                                <ul class="mission-list">
                                    @foreach ($missionItems as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>{{ $missionText }}</p>
                            @endif
                        </div>
                    </section>
                @elseif ($currentSlug === 'lokasi')
                    @if (!empty($currentPage['map_embed_url']))
                        <div class="map-embed-card" aria-label="Peta Lokasi" style="max-width: 920px; width: 100%; margin: 0 auto 1.5rem; padding: 0.9rem;  box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08); overflow: hidden;">
                            <div style="overflow: hidden; border-radius: 14px;">
                                <iframe src="{{ $currentPage['map_embed_url'] }}" width="100%" height="460" style="border:0; display:block; width:100%; min-height: 260px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        @if (!empty($currentPage['map_url']))
                            <div style="text-align: center; margin: -0.5rem auto 1.5rem;">
                                <a href="{{ $currentPage['map_url'] }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.7rem 1.1rem; border-radius: 999px; background: #bf0a0a; color: #ffffff; font-weight: 600; text-decoration: none; box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2); transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;"
                                   onmouseover="this.style.backgroundColor='#a10808'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 24px rgba(191, 10, 10, 0.25)'"
                                   onmouseout="this.style.backgroundColor='#bf0a0a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(37, 99, 235, 0.2)'">
                                    Buka di Maps
                                </a>
                            </div>
                        @endif
                    @elseif (!empty($currentPage['map_url']))
                        <p>Link peta tidak dapat ditampilkan. Pastikan URL Google Maps valid dan coba lagi.</p>
                    @else
                        <p>Link peta belum diatur. Silakan cek halaman Kelola Lokasi.</p>
                    @endif
                @elseif ($currentSlug === 'penyewaan')
                    @if (!empty($currentPage['link']))
                        <div class="map-embed-card" aria-label="Penyewaan" style="max-width: 920px; width: 100%; margin: 0 auto 1.5rem; padding: 0.9rem;  box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08); overflow: hidden;">
                            <div style="overflow: hidden; border-radius: 14px;">
                                <iframe src="{{ $currentPage['link'] }}" width="100%" height="460" style="border:0; display:block; width:100%; min-height: 260px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <!-- Tombol 'Buka Link Penyewaan' dihapus sesuai permintaan -->
                        <p class="lead headline-center" style="margin: 0.6rem auto 0;">Untuk booking studio silahkan menghubungi via Whatsapp</p>
                        @if (!empty($currentPage['whatsapp_link']))
                            <div style="text-align: center; margin-top: 0.6rem;">
                                <a href="{{ $currentPage['whatsapp_link'] }}" target="_blank" rel="noopener noreferrer" class="whatsapp-btn">
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true" style="flex: 0 0 auto;">
                                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.7-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                    {{ !empty($currentPage['whatsapp_name']) ? $currentPage['whatsapp_name'] : 'WhatsApp' }}
                                </a>
                            </div>
                        @endif
                    @else
                        <p>Link penyewaan belum diatur. Silakan cek halaman Kelola Penyewaan.</p>
                    @endif
                    @if (!empty($currentPage['content']))
                        <p class="lead">{{ $currentPage['content'] }}</p>
                    @endif
                @elseif ($currentSlug === 'undangan-media-partner')
                    @if (!empty($currentPage['images']))
                        <section class="undangan-carousel" aria-label="Galeri Undangan">
                            <div class="undangan-carousel-track" id="undanganCarouselTrack">
                                @foreach ($currentPage['images'] as $imageUrl)
                                    <article class="undangan-image-card">
                                        <img src="{{ $imageUrl }}" alt="Gambar Undangan">
                                    </article>
                                @endforeach
                            </div>
                            <div class="undangan-carousel-dots" id="undanganCarouselDots"></div>
                        </section>
                        @if (!empty($currentPage['whatsapp_link']))
                            <div style="text-align: center; margin-top: 1rem;">
                                <a href="{{ $currentPage['whatsapp_link'] }}" target="_blank" rel="noopener noreferrer" class="whatsapp-btn">
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true" style="flex: 0 0 auto;">
                                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.7-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                    {{ !empty($currentPage['whatsapp_name']) ? $currentPage['whatsapp_name'] : 'WhatsApp' }}
                                </a>
                            </div>
                        @endif
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const track = document.getElementById('undanganCarouselTrack');
                                const dots = document.getElementById('undanganCarouselDots');
                                if (!track || !dots) {
                                    return;
                                }

                                const cards = Array.from(track.querySelectorAll('.undangan-image-card'));
                                if (cards.length === 0) {
                                    return;
                                }

                                cards.forEach((card, index) => {
                                    const dot = document.createElement('button');
                                    dot.type = 'button';
                                    dot.className = 'undangan-dot' + (index === 0 ? ' active' : '');
                                    dot.addEventListener('click', function () {
                                        track.scrollTo({ left: card.offsetLeft, behavior: 'smooth' });
                                    });
                                    dots.appendChild(dot);
                                });

                                track.addEventListener('scroll', function () {
                                    const activeIndex = cards.findIndex((card) => Math.abs(card.offsetLeft - track.scrollLeft) < card.clientWidth / 2);
                                    dots.querySelectorAll('.undangan-dot').forEach((dot, idx) => {
                                        dot.classList.toggle('active', idx === (activeIndex === -1 ? 0 : activeIndex));
                                    });
                                });
                            });
                        </script>
                    @else
                        <p class="lead">Belum ada gambar undangan yang ditambahkan.</p>
                    @endif
                @elseif ($currentSlug === 'rilisan')
                    @if (!empty($currentPage['items']) && is_array($currentPage['items']))
                        <section class="vinyl-layout" aria-label="Rilisan Vinyl Player">
                            <div class="vinyl-player" id="vinylPlayer" aria-label="Vinyl Player">
                                <div class="vinyl-player-top">Tarik vinyl ke sini untuk memutar lagu</div>
                                <div class="vinyl-player-disc" id="vinylDropZone" aria-label="Zona Pemutar Vinyl"></div>
                                <div class="vinyl-player-info">
                                    <p class="vinyl-player-title" id="playerTrackTitle">Pilih rilisan untuk memutar</p>
                                    <p class="vinyl-player-subtitle" id="playerTrackArtist">Drag vinyl ke player</p>
                                </div>
                                <div class="vinyl-player-controls">
                                    <button type="button" class="btn btn-primary" id="playPauseBtn" disabled>Putar</button>
                                </div>
                                <audio id="vinylAudio" preload="none"></audio>
                            </div>

                            <div class="vinyl-list" aria-label="Daftar Vinyl Rilisan">
                                @foreach ($currentPage['items'] as $index => $item)
                                    <article class="card vinyl-card" draggable="true" data-index="{{ $index }}" data-audio-url="{{ $item['audio_url'] ?? '' }}" data-title="{{ $item['title'] }}" data-artist="{{ $item['artist'] ?? '' }}">
                                        <div class="profile-body">
                                            <h2 class="profile-name">{{ $item['title'] }}</h2>
                                            <p class="booklet-description">{{ $item['artist'] ?? 'Tanpa artis' }}</p>
                                            @if (!empty($item['type']))
                                                <p class="booklet-description">{{ $item['type'] }}</p>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @else
                        @if (!empty($currentPage['content']))
                            <p class="lead">{{ $currentPage['content'] }}</p>
                        @else
                            <p class="lead">Belum ada rilisan yang ditambahkan.</p>
                        @endif
                    @endif
                @elseif (!in_array($currentSlug, ['ketum', 'waketum'], true) && !empty($currentPage['content']))
                    <p class="lead">{{ $currentPage['content'] }}</p>
                @endif

                @if ($currentSlug === 'booklet-band')
                    @if (!empty($currentPage['cards']))
                        <section class="cards cards-center" aria-label="Booklet Band">
                            @foreach ($currentPage['cards'] as $card)
                                <article class="card booklet-card">
                                    <div class="booklet-photo-wrap">
                                        @if (!empty($card['photo_url']))
                                            <img class="booklet-photo" src="{{ $card['photo_url'] }}" alt="Foto {{ $card['name'] ?? 'Band' }}">
                                        @else
                                            <div class="booklet-photo-placeholder">Foto Band</div>
                                        @endif
                                    </div>
                                    <div class="profile-body">
                                        <h2 class="profile-name">{{ $card['name'] ?? 'Nama Band' }}</h2>
                                        <p class="booklet-description">{{ $card['description'] ?? '' }}</p>
                                        @if (!empty($card['role']))
                                            @php
                                                $roles = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $card['role'])), fn($item) => $item !== '');
                                            @endphp
                                            @if (!empty($roles))
                                                <p class="role-heading">Role</p>
                                                <ul class="role-list">
                                                    @foreach ($roles as $roleItem)
                                                        <li>{{ $roleItem }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endif

                                        @if (!empty($card['whatsapp_link']))
                                            <div style="margin-top:1rem;">
                                                <a href="{{ $card['whatsapp_link'] }}" target="_blank" rel="noopener noreferrer" class="whatsapp-btn">
                                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true" style="flex: 0 0 auto;">
                                                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.7-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                                    </svg>
                                                    {{ !empty($card['whatsapp_name']) ? $card['whatsapp_name'] : 'WhatsApp' }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </section>
                    @else
                        <p class="lead">Belum ada profil band yang ditambahkan.</p>
                    @endif
                @endif

                @if ($currentSlug === 'ketum')
                    <section class="profile-card" aria-label="Kartu Profil Ketum">
                        <div class="profile-photo-wrap">
                            @if (!empty($currentPage['photo_url']))
                                <img class="profile-photo" src="{{ $currentPage['photo_url'] }}" alt="Foto {{ $currentPage['name'] ?? 'Ketum' }}">
                            @else
                                <div class="profile-photo-placeholder">Foto</div>
                            @endif
                        </div>
                        <div class="profile-body">
                            <h2 class="profile-name">{{ $currentPage['name'] ?? 'Nama Ketum' }}</h2>
                            <p class="profile-position">{{ $currentPage['position'] ?? 'Ketua Umum' }}</p>
                        </div>
                    </section>
                @endif

                @if (in_array($currentSlug, ['manajemen-event', 'manajemen-talent', 'produksi', 'rumah-tangga', 'psdm'], true) && !empty($currentPage['cards']))
                    @php
                        $leaderCards = array_slice($currentPage['cards'], 0, 2);
                        $staffCards = array_slice($currentPage['cards'], 2);
                        if ($currentSlug === 'manajemen-talent') {
                            $teamLabel = 'Manajemen Talent';
                        } elseif ($currentSlug === 'produksi') {
                            $teamLabel = 'Produksi';
                        } elseif ($currentSlug === 'rumah-tangga') {
                            $teamLabel = 'Rumah Tangga';
                        } elseif ($currentSlug === 'psdm') {
                            $teamLabel = 'PSDM';
                        } else {
                            $teamLabel = 'Manajemen Event';
                        }
                    @endphp

                    <section class="cards cards-center" aria-label="Kartu Inti {{ $teamLabel }}">
                        @foreach ($leaderCards as $card)
                            <article class="profile-card">
                                <div class="profile-photo-wrap">
                                    @if (!empty($card['photo_url']))
                                        <img class="profile-photo" src="{{ $card['photo_url'] }}" alt="Foto {{ $card['name'] ?? $teamLabel }}">
                                    @else
                                        <div class="profile-photo-placeholder">Foto</div>
                                    @endif
                                </div>
                                <div class="profile-body">
                                    <h2 class="profile-name">{{ $card['name'] ?? 'Nama Pengurus' }}</h2>
                                    <p class="profile-position">{{ $card['position'] ?? $teamLabel }}</p>
                                </div>
                            </article>
                        @endforeach
                    </section>

                    @if (!empty($staffCards))
                        <h2 class="headline headline-center" style="margin-top: 8px; font-size: clamp(1.1rem, 2.8vw, 1.35rem);">Staff {{ $teamLabel }}</h2>
                        <section class="cards cards-center" aria-label="Kartu Staff {{ $teamLabel }}">
                            @foreach ($staffCards as $card)
                                <article class="profile-card">
                                    <div class="profile-photo-wrap">
                                        @if (!empty($card['photo_url']))
                                            <img class="profile-photo" src="{{ $card['photo_url'] }}" alt="Foto {{ $card['name'] ?? ('Staff ' . $teamLabel) }}">
                                        @else
                                            <div class="profile-photo-placeholder">Foto</div>
                                        @endif
                                    </div>
                                    <div class="profile-body">
                                        <h2 class="profile-name">{{ $card['name'] ?? 'Nama Staff' }}</h2>
                                        <p class="profile-position">{{ $card['position'] ?? 'Staff' }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </section>
                    @endif
                @elseif (in_array($currentSlug, ['waketum', 'sekben', 'litbang'], true) && !empty($currentPage['cards']))
                    <section class="cards cards-center" aria-label="Kartu Profil Pengurus">
                        @foreach ($currentPage['cards'] as $card)
                            <article class="profile-card">
                                <div class="profile-photo-wrap">
                                    @if (!empty($card['photo_url']))
                                        <img class="profile-photo" src="{{ $card['photo_url'] }}" alt="Foto {{ $card['name'] ?? 'Pengurus' }}">
                                    @else
                                        <div class="profile-photo-placeholder">Foto</div>
                                    @endif
                                </div>
                                <div class="profile-body">
                                    <h2 class="profile-name">{{ $card['name'] ?? 'Nama Pengurus' }}</h2>
                                    <p class="profile-position">{{ $card['position'] ?? 'Pengurus' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </section>
                @endif


            </article>
        @endif
    </section>

    <footer class="site-footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>

    <script>
        (function () {
            var toggle = document.getElementById('menuToggle');
            var sidebar = document.getElementById('sidebarMenu');
            var backdrop = document.getElementById('menuBackdrop');
            var menuLinks = sidebar ? sidebar.querySelectorAll('a') : [];

            if (!toggle || !sidebar || !backdrop) {
                return;
            }

            function closeMenu() {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            }

            function openMenu() {
                sidebar.classList.toggle('open');
                backdrop.classList.toggle('show');
            }

            toggle.addEventListener('click', openMenu);
            backdrop.addEventListener('click', closeMenu);

            for (var i = 0; i < menuLinks.length; i++) {
                menuLinks[i].addEventListener('click', closeMenu);
            }
        })();

        (function () {
            var player = document.getElementById('vinylPlayer');
            var dropZone = document.getElementById('vinylDropZone');
            var playerTitle = document.getElementById('playerTrackTitle');
            var playerArtist = document.getElementById('playerTrackArtist');
            var playPauseBtn = document.getElementById('playPauseBtn');
            var audio = document.getElementById('vinylAudio');
            var currentTrack = null;

            if (!player || !dropZone || !playerTitle || !playerArtist || !playPauseBtn || !audio) {
                return;
            }

            function setTrack(track) {
                currentTrack = track;
                audio.src = track.audioUrl || '';
                playerTitle.textContent = track.title || 'Unknown track';
                playerArtist.textContent = track.artist || 'Unknown artist';
                playPauseBtn.disabled = !track.audioUrl;
                if (!track.audioUrl) {
                    playPauseBtn.textContent = 'Audio tidak tersedia';
                } else {
                    playPauseBtn.textContent = 'Putar';
                }
            }

            function clearTrack() {
                currentTrack = null;
                audio.pause();
                audio.removeAttribute('src');
                audio.load();
                playerTitle.textContent = 'Pilih rilisan untuk memutar';
                playerArtist.textContent = 'Drag vinyl ke player';
                playPauseBtn.disabled = true;
                playPauseBtn.textContent = 'Putar';
                dropZone.classList.remove('active');
            }

            function handleDragStart(event) {
                var card = event.currentTarget;
                if (!card) {
                    return;
                }

                event.dataTransfer.setData('text/plain', card.dataset.index || '');
                setTimeout(function () {
                    card.classList.add('dragging');
                }, 0);
            }

            function handleDragEnd(event) {
                var card = event.currentTarget;
                if (card) {
                    card.classList.remove('dragging');
                }
            }

            function handleDrop(event) {
                event.preventDefault();
                dropZone.classList.remove('active');
                var index = event.dataTransfer.getData('text/plain');
                var card = document.querySelector('.vinyl-card[data-index="' + index + '"]');
                if (!card) {
                    return;
                }

                if (!card.dataset.audioUrl) {
                    playerTitle.textContent = 'Audio tidak tersedia';
                    playerArtist.textContent = card.dataset.title || 'Tidak ada audio';
                    playPauseBtn.disabled = true;
                    return;
                }

                setTrack({
                    title: card.dataset.title,
                    artist: card.dataset.artist,
                    audioUrl: card.dataset.audioUrl,
                });
                player.classList.add('active');
            }

            function handleDragOver(event) {
                event.preventDefault();
                dropZone.classList.add('active');
            }

            function handleDragLeave() {
                dropZone.classList.remove('active');
            }

            function togglePlayback() {
                if (!currentTrack || !audio.src) {
                    return;
                }

                if (audio.paused) {
                    audio.play().catch(function () {
                        playPauseBtn.textContent = 'Putar';
                    });
                    playPauseBtn.textContent = 'Jeda';
                } else {
                    audio.pause();
                    playPauseBtn.textContent = 'Putar';
                }
            }

            playPauseBtn.addEventListener('click', togglePlayback);
            dropZone.addEventListener('dragover', handleDragOver);
            dropZone.addEventListener('drop', handleDrop);
            dropZone.addEventListener('dragleave', handleDragLeave);

            document.querySelectorAll('.vinyl-card').forEach(function (card) {
                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);
            });

            audio.addEventListener('ended', function () {
                playPauseBtn.textContent = 'Putar';
            });
        })();
    </script>
</body>
</html>
