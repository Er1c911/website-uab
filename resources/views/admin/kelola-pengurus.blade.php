<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Pengurus</title>
    <style>
        :root {
            --line: #292929;
            --text: #f4f4f4;
            --muted: #b8b8b8;
            --accent: #d90b1c;
            --accent-strong: #ff2b41;
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
                radial-gradient(circle at 12% 16%, rgba(217, 11, 28, 0.2), transparent 32%),
                linear-gradient(155deg, #030303 0%, #101010 100%);
            display: flex;
            flex-direction: column;
        }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 28px 18px;
            flex: 1;
        }

        .site-footer {
            border-top: 1px solid #2d2d2d;
            text-align: center;
            padding: 14px 16px;
            color: #c7c7c7;
            font-size: 0.86rem;
            background: rgba(8, 8, 8, 0.9);
        }

        .panel {
            border: 1px solid var(--line);
            background: rgba(16, 16, 16, 0.88);
            border-radius: 16px;
            padding: 20px;
        }

        .tag {
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.72rem;
            color: var(--accent-strong);
            font-weight: 800;
        }

        h1 {
            margin: 8px 0 10px;
            font-size: clamp(1.4rem, 4vw, 2rem);
        }

        p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .switcher {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .switch-btn {
            border: 1px solid #4a4a4a;
            border-radius: 10px;
            padding: 9px 14px;
            color: #f5f5f5;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
        }

        .switch-btn.active {
            border-color: transparent;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            color: #fff;
        }

        .editor {
            margin-top: 16px;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 14px;
            background: rgba(10, 10, 10, 0.65);
            display: none;
        }

        .editor.active {
            display: block;
        }

        .field {
            margin-bottom: 12px;
        }

        .field label {
            display: block;
            margin-bottom: 6px;
            color: #e8e8e8;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .field input,
        .field textarea {
            width: 100%;
            border: 1px solid #3f3f3f;
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(8, 8, 8, 0.9);
            color: #f5f5f5;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .field textarea {
            min-height: 110px;
            resize: vertical;
        }

        .save-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .form-block {
            border: 1px solid #353535;
            border-radius: 12px;
            padding: 12px;
            background: rgba(14, 14, 14, 0.65);
            margin-bottom: 12px;
        }

        .form-block h2 {
            margin: 0 0 10px;
            font-size: 1rem;
            color: #f2f2f2;
        }

            .card-item {
                border: 1px solid #343434;
                border-radius: 12px;
                padding: 12px;
                margin-bottom: 10px;
                background: rgba(12, 12, 12, 0.7);
            }

            .card-item-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                margin-bottom: 10px;
            }

            .card-item-title {
                margin: 0;
                color: #f0f0f0;
                font-size: 0.94rem;
                font-weight: 700;
            }

            .btn-danger {
                border: 1px solid #7f1d1d;
                background: rgba(127, 29, 29, 0.22);
                color: #ffdada;
            }

            .btn-danger:hover {
                border-color: #ef4444;
                background: rgba(239, 68, 68, 0.3);
            }

        .hint {
            margin: 0;
            color: #c8c8c8;
            font-size: 0.86rem;
        }

        .photo-preview {
            width: min(220px, 100%);
            border: 1px solid #3f3f3f;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 10px;
            background: #0b0b0b;
        }

        .photo-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .photo-label {
            margin-top: 10px;
            color: #d0d0d0;
            font-size: 0.84rem;
        }

        .notice {
            margin-top: 14px;
            border: 1px solid rgba(255, 43, 65, 0.5);
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(217, 11, 28, 0.15);
            color: #ffd8dd;
        }

        .validation {
            margin-top: 14px;
            border: 1px solid rgba(245, 158, 11, 0.5);
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(120, 53, 15, 0.2);
            color: #fde68a;
        }

        .btn {
            text-decoration: none;
            border: 1px solid #4a4a4a;
            border-radius: 10px;
            padding: 9px 14px;
            color: #f5f5f5;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
        }

        .btn:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.2);
        }

        .btn-primary {
            border-color: transparent;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            color: #fff;
        }

        .btn-primary:hover {
            filter: brightness(1.1);
        }

        @media (max-width: 560px) {
            .container {
                padding: 16px 12px;
            }

            .panel {
                border-radius: 12px;
                padding: 14px;
            }

            .actions .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="panel">
            <p class="tag">Admin Panel</p>
            <h1>Kelola Pengurus</h1>
            <p>Halaman ini disiapkan untuk pengelolaan data pengurus UAB.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <div class="switcher">
                <button type="button" class="switch-btn active" data-target="ketumEditor">Ketum</button>
                <button type="button" class="switch-btn" data-target="waketumEditor">Waketum</button>
                <button type="button" class="switch-btn" data-target="sekbenEditor">Sekben</button>
                <button type="button" class="switch-btn" data-target="litbangEditor">Litbang</button>
                <button type="button" class="switch-btn" data-target="manajemenEventEditor">Manajemen Event</button>
                <button type="button" class="switch-btn" data-target="manajemenTalentEditor">Manajemen Talent</button>
                <button type="button" class="switch-btn" data-target="produksiEditor">Produksi</button>
                <button type="button" class="switch-btn" data-target="rumahTanggaEditor">Rumah Tangga</button>
                <button type="button" class="switch-btn" data-target="psdmEditor">PSDM</button>
            </div>

            <section id="ketumEditor" class="editor active" aria-label="Editor Ketum">
                <section class="form-block" aria-label="Form Halaman Ketum">
                    <h2>Pengelolaan Halaman Ketum</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'ketum']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="ketum-title">Judul Halaman Ketum</label>
                            <input id="ketum-title" type="text" name="title" value="{{ old('title', $profiles['ketum']['title']) }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Ketum</button>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Ketum">
                    <h2>Pengelolaan Card Ketum</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'ketum']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="card">
                        <div class="field">
                            <label for="ketum-name">Nama Ketum</label>
                            <input id="ketum-name" type="text" name="name" value="{{ old('name', $profiles['ketum']['name'] ?? '') }}" required>
                        </div>
                        <div class="field">
                            <label for="ketum-position">Jabatan Ketum</label>
                            <input id="ketum-position" type="text" name="position" value="{{ old('position', $profiles['ketum']['position'] ?? 'Ketua Umum') }}" required>
                        </div>
                        <div class="field">
                            <label for="ketum-photo-url">URL Foto Ketum</label>
                            <input
                                id="ketum-photo-url"
                                type="url"
                                name="photo_url"
                                value="{{ old('photo_url', $profiles['ketum']['photo_url'] ?? '') }}"
                                placeholder="https://contoh.com/foto-ketum.jpg"
                            >
                            <p class="photo-label">Gunakan link foto langsung (jpg/png/webp). Jika kosong, foto sebelumnya tetap dipakai.</p>
                            @if (!empty($profiles['ketum']['photo_url']))
                                <div class="photo-preview">
                                    <img src="{{ $profiles['ketum']['photo_url'] }}" alt="Foto Ketum">
                                </div>
                            @elseif (!empty($profiles['ketum']['photo']))
                                <div class="photo-preview">
                                    <img src="{{ asset($profiles['ketum']['photo']) }}" alt="Foto Ketum">
                                </div>
                            @endif
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Card Ketum</button>
                            <a class="btn" href="{{ route('user.ketum') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>
            </section>

            <section id="waketumEditor" class="editor" aria-label="Editor Waketum">
                <section class="form-block" aria-label="Form Halaman Waketum">
                    <h2>Pengelolaan Halaman Waketum</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'waketum']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="waketum-title">Judul Halaman Waketum</label>
                            <input id="waketum-title" type="text" name="title" value="{{ old('title', $profiles['waketum']['title']) }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Waketum</button>
                            <a class="btn" href="{{ route('user.waketum') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Waketum">
                    <h2>Pengelolaan Card Waketum</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'waketum']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $waketumCards = old('cards', $profiles['waketum']['cards'] ?? []);
                            if (empty($waketumCards)) {
                                $waketumCards = [['name' => '', 'position' => '', 'photo_url' => '']];
                            }
                        @endphp

                        <div id="waketumCardsContainer">
                            @foreach ($waketumCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Waketum #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-waketum-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Waketum</label>
                                        <input type="text" name="cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan Waketum</label>
                                        <input type="text" name="cards[{{ $index }}][position]" value="{{ $card['position'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Waketum</label>
                                        <input type="url" name="cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-waketum.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addWaketumCard">Tambah Card</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Waketum</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="sekbenEditor" class="editor" aria-label="Editor Sekben">
                <section class="form-block" aria-label="Form Halaman Sekben">
                    <h2>Pengelolaan Halaman Sekben</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'sekben']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="sekben-title">Judul Halaman Sekben</label>
                            <input id="sekben-title" type="text" name="title" value="{{ old('title', $profiles['sekben']['title'] ?? 'Sekretaris Bendahara UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Sekben</button>
                            <a class="btn" href="{{ route('user.sekben') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Sekben">
                    <h2>Pengelolaan Card Sekben</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'sekben']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $sekbenCards = old('cards', $profiles['sekben']['cards'] ?? []);
                            if (empty($sekbenCards)) {
                                $sekbenCards = [['name' => '', 'position' => '', 'photo_url' => '']];
                            }
                        @endphp

                        <div id="sekbenCardsContainer">
                            @foreach ($sekbenCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Sekben #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-sekben-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Sekben</label>
                                        <input type="text" name="cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan Sekben</label>
                                        <input type="text" name="cards[{{ $index }}][position]" value="{{ $card['position'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Sekben</label>
                                        <input type="url" name="cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-sekben.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addSekbenCard">Tambah Card</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Sekben</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="litbangEditor" class="editor" aria-label="Editor Litbang">
                <section class="form-block" aria-label="Form Halaman Litbang">
                    <h2>Pengelolaan Halaman Litbang</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'litbang']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="litbang-title">Judul Halaman Litbang</label>
                            <input id="litbang-title" type="text" name="title" value="{{ old('title', $profiles['litbang']['title'] ?? 'Penelitian dan Pengembangan UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Litbang</button>
                            <a class="btn" href="{{ route('user.litbang') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Litbang">
                    <h2>Pengelolaan Card Litbang</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'litbang']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $litbangCards = old('cards', $profiles['litbang']['cards'] ?? []);
                            if (empty($litbangCards)) {
                                $litbangCards = [['name' => '', 'position' => '', 'photo_url' => '']];
                            }
                        @endphp

                        <div id="litbangCardsContainer">
                            @foreach ($litbangCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Litbang #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-litbang-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Litbang</label>
                                        <input type="text" name="cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan Litbang</label>
                                        <input type="text" name="cards[{{ $index }}][position]" value="{{ $card['position'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Litbang</label>
                                        <input type="url" name="cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-litbang.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addLitbangCard">Tambah Card</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Litbang</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="manajemenEventEditor" class="editor" aria-label="Editor Manajemen Event">
                <section class="form-block" aria-label="Form Halaman Manajemen Event">
                    <h2>Pengelolaan Halaman Manajemen Event</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'manajemen-event']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="manajemen-event-title">Judul Halaman Manajemen Event</label>
                            <input id="manajemen-event-title" type="text" name="title" value="{{ old('title', $profiles['manajemen-event']['title'] ?? 'Manajemen Event UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Manajemen Event</button>
                            <a class="btn" href="{{ route('user.manajemen-event') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Manajemen Event">
                    <h2>Pengelolaan Card Manajemen Event</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'manajemen-event']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $manajemenEventCards = $profiles['manajemen-event']['cards'] ?? [];
                            $leaderCard = $manajemenEventCards[0] ?? ['name' => '', 'position' => 'Kepala Divisi', 'photo_url' => null];
                            $viceCard = $manajemenEventCards[1] ?? ['name' => '', 'position' => 'Wakil Kepala Divisi', 'photo_url' => null];
                            $staffCards = old('staff_cards', array_slice($manajemenEventCards, 2));
                        @endphp

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Kepala Divisi</label>
                                <input type="text" name="leader_name" value="{{ old('leader_name', $leaderCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Kepala Divisi</label>
                                <input type="url" name="leader_photo_url" value="{{ old('leader_photo_url', $leaderCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-kepala-divisi.jpg">
                            </div>
                        </article>

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Wakil Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Wakil Kepala Divisi</label>
                                <input type="text" name="vice_name" value="{{ old('vice_name', $viceCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Wakil Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Wakil Kepala Divisi</label>
                                <input type="url" name="vice_photo_url" value="{{ old('vice_photo_url', $viceCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-wakil-kepala-divisi.jpg">
                            </div>
                        </article>

                        <h3 style="margin: 8px 0 10px; font-size: 0.98rem; color: #f2f2f2;">Daftar Staff</h3>
                        <div id="manajemenEventStaffContainer">
                            @foreach ($staffCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Staff #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-manajemen-event-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Staff</label>
                                        <input type="text" name="staff_cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan</label>
                                        <input type="text" value="Staff" readonly>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Staff</label>
                                        <input type="url" name="staff_cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-staff-event.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addManajemenEventStaffCard">Tambah Card Staff</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Manajemen Event</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="manajemenTalentEditor" class="editor" aria-label="Editor Manajemen Talent">
                <section class="form-block" aria-label="Form Halaman Manajemen Talent">
                    <h2>Pengelolaan Halaman Manajemen Talent</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'manajemen-talent']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="manajemen-talent-title">Judul Halaman Manajemen Talent</label>
                            <input id="manajemen-talent-title" type="text" name="title" value="{{ old('title', $profiles['manajemen-talent']['title'] ?? 'Manajemen Talent UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Manajemen Talent</button>
                            <a class="btn" href="{{ route('user.manajemen-talent') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Manajemen Talent">
                    <h2>Pengelolaan Card Manajemen Talent</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'manajemen-talent']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $manajemenTalentCards = $profiles['manajemen-talent']['cards'] ?? [];
                            $talentLeaderCard = $manajemenTalentCards[0] ?? ['name' => '', 'position' => 'Kepala Divisi', 'photo_url' => null];
                            $talentViceCard = $manajemenTalentCards[1] ?? ['name' => '', 'position' => 'Wakil Kepala Divisi', 'photo_url' => null];
                            $talentStaffCards = old('staff_cards', array_slice($manajemenTalentCards, 2));
                        @endphp

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Kepala Divisi</label>
                                <input type="text" name="leader_name" value="{{ old('leader_name', $talentLeaderCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Kepala Divisi</label>
                                <input type="url" name="leader_photo_url" value="{{ old('leader_photo_url', $talentLeaderCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-kepala-divisi-talent.jpg">
                            </div>
                        </article>

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Wakil Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Wakil Kepala Divisi</label>
                                <input type="text" name="vice_name" value="{{ old('vice_name', $talentViceCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Wakil Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Wakil Kepala Divisi</label>
                                <input type="url" name="vice_photo_url" value="{{ old('vice_photo_url', $talentViceCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-wakil-kepala-divisi-talent.jpg">
                            </div>
                        </article>

                        <h3 style="margin: 8px 0 10px; font-size: 0.98rem; color: #f2f2f2;">Daftar Staff</h3>
                        <div id="manajemenTalentStaffContainer">
                            @foreach ($talentStaffCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Staff #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-manajemen-talent-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Staff</label>
                                        <input type="text" name="staff_cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan</label>
                                        <input type="text" value="Staff" readonly>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Staff</label>
                                        <input type="url" name="staff_cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-staff-talent.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addManajemenTalentStaffCard">Tambah Card Staff</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Manajemen Talent</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="produksiEditor" class="editor" aria-label="Editor Produksi">
                <section class="form-block" aria-label="Form Halaman Produksi">
                    <h2>Pengelolaan Halaman Produksi</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'produksi']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="produksi-title">Judul Halaman Produksi</label>
                            <input id="produksi-title" type="text" name="title" value="{{ old('title', $profiles['produksi']['title'] ?? 'Produksi UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Produksi</button>
                            <a class="btn" href="{{ route('user.produksi') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Produksi">
                    <h2>Pengelolaan Card Produksi</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'produksi']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $produksiCards = $profiles['produksi']['cards'] ?? [];
                            $produksiLeaderCard = $produksiCards[0] ?? ['name' => '', 'position' => 'Kepala Divisi', 'photo_url' => null];
                            $produksiViceCard = $produksiCards[1] ?? ['name' => '', 'position' => 'Wakil Kepala Divisi', 'photo_url' => null];
                            $produksiStaffCards = old('staff_cards', array_slice($produksiCards, 2));
                        @endphp

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Kepala Divisi</label>
                                <input type="text" name="leader_name" value="{{ old('leader_name', $produksiLeaderCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Kepala Divisi</label>
                                <input type="url" name="leader_photo_url" value="{{ old('leader_photo_url', $produksiLeaderCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-kepala-divisi-produksi.jpg">
                            </div>
                        </article>

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Wakil Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Wakil Kepala Divisi</label>
                                <input type="text" name="vice_name" value="{{ old('vice_name', $produksiViceCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Wakil Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Wakil Kepala Divisi</label>
                                <input type="url" name="vice_photo_url" value="{{ old('vice_photo_url', $produksiViceCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-wakil-kepala-divisi-produksi.jpg">
                            </div>
                        </article>

                        <h3 style="margin: 8px 0 10px; font-size: 0.98rem; color: #f2f2f2;">Daftar Staff</h3>
                        <div id="produksiStaffContainer">
                            @foreach ($produksiStaffCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Staff #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-produksi-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Staff</label>
                                        <input type="text" name="staff_cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan</label>
                                        <input type="text" value="Staff" readonly>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Staff</label>
                                        <input type="url" name="staff_cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-staff-produksi.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addProduksiStaffCard">Tambah Card Staff</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Produksi</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="rumahTanggaEditor" class="editor" aria-label="Editor Rumah Tangga">
                <section class="form-block" aria-label="Form Halaman Rumah Tangga">
                    <h2>Pengelolaan Halaman Rumah Tangga</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'rumah-tangga']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="rumah-tangga-title">Judul Halaman Rumah Tangga</label>
                            <input id="rumah-tangga-title" type="text" name="title" value="{{ old('title', $profiles['rumah-tangga']['title'] ?? 'Rumah Tangga UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman Rumah Tangga</button>
                            <a class="btn" href="{{ route('user.rumah-tangga') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card Rumah Tangga">
                    <h2>Pengelolaan Card Rumah Tangga</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'rumah-tangga']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $rumahTanggaCards = $profiles['rumah-tangga']['cards'] ?? [];
                            $rumahTanggaLeaderCard = $rumahTanggaCards[0] ?? ['name' => '', 'position' => 'Kepala Divisi', 'photo_url' => null];
                            $rumahTanggaViceCard = $rumahTanggaCards[1] ?? ['name' => '', 'position' => 'Wakil Kepala Divisi', 'photo_url' => null];
                            $rumahTanggaStaffCards = old('staff_cards', array_slice($rumahTanggaCards, 2));
                        @endphp

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Kepala Divisi</label>
                                <input type="text" name="leader_name" value="{{ old('leader_name', $rumahTanggaLeaderCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Kepala Divisi</label>
                                <input type="url" name="leader_photo_url" value="{{ old('leader_photo_url', $rumahTanggaLeaderCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-kepala-divisi-rumahtangga.jpg">
                            </div>
                        </article>

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Wakil Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Wakil Kepala Divisi</label>
                                <input type="text" name="vice_name" value="{{ old('vice_name', $rumahTanggaViceCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Wakil Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Wakil Kepala Divisi</label>
                                <input type="url" name="vice_photo_url" value="{{ old('vice_photo_url', $rumahTanggaViceCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-wakil-kepala-divisi-rumahtangga.jpg">
                            </div>
                        </article>

                        <h3 style="margin: 8px 0 10px; font-size: 0.98rem; color: #f2f2f2;">Daftar Staff</h3>
                        <div id="rumahTanggaStaffContainer">
                            @foreach ($rumahTanggaStaffCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Staff #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-rumah-tangga-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Staff</label>
                                        <input type="text" name="staff_cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan</label>
                                        <input type="text" value="Staff" readonly>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Staff</label>
                                        <input type="url" name="staff_cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-staff-rumahtangga.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addRumahTanggaStaffCard">Tambah Card Staff</button>
                            <button class="btn btn-primary" type="submit">Simpan Card Rumah Tangga</button>
                        </div>
                    </form>
                </section>
            </section>

            <section id="psdmEditor" class="editor" aria-label="Editor PSDM">
                <section class="form-block" aria-label="Form Halaman PSDM">
                    <h2>Pengelolaan Halaman PSDM</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'psdm']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="page">
                        <div class="field">
                            <label for="psdm-title">Judul Halaman PSDM</label>
                            <input id="psdm-title" type="text" name="title" value="{{ old('title', $profiles['psdm']['title'] ?? 'PSDM UAB') }}" required>
                        </div>
                        <div class="save-row">
                            <button class="btn btn-primary" type="submit">Simpan Halaman PSDM</button>
                            <a class="btn" href="{{ route('user.psdm') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        </div>
                    </form>
                </section>

                <section class="form-block" aria-label="Form Card PSDM">
                    <h2>Pengelolaan Card PSDM</h2>
                    <form method="POST" action="{{ route('admin.kelola-pengurus.update', ['role' => 'psdm']) }}">
                        @csrf
                        <input type="hidden" name="form_type" value="cards">

                        @php
                            $psdmCards = $profiles['psdm']['cards'] ?? [];
                            $psdmLeaderCard = $psdmCards[0] ?? ['name' => '', 'position' => 'Kepala Divisi', 'photo_url' => null];
                            $psdmViceCard = $psdmCards[1] ?? ['name' => '', 'position' => 'Wakil Kepala Divisi', 'photo_url' => null];
                            $psdmStaffCards = old('staff_cards', array_slice($psdmCards, 2));
                        @endphp

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Kepala Divisi</label>
                                <input type="text" name="leader_name" value="{{ old('leader_name', $psdmLeaderCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Kepala Divisi</label>
                                <input type="url" name="leader_photo_url" value="{{ old('leader_photo_url', $psdmLeaderCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-kepala-divisi-psdm.jpg">
                            </div>
                        </article>

                        <article class="card-item">
                            <div class="card-item-head">
                                <p class="card-item-title">Card Wakil Kepala Divisi</p>
                            </div>

                            <div class="field">
                                <label>Nama Wakil Kepala Divisi</label>
                                <input type="text" name="vice_name" value="{{ old('vice_name', $psdmViceCard['name'] ?? '') }}" required>
                            </div>

                            <div class="field">
                                <label>Jabatan</label>
                                <input type="text" value="Wakil Kepala Divisi" readonly>
                            </div>

                            <div class="field">
                                <label>URL Foto Wakil Kepala Divisi</label>
                                <input type="url" name="vice_photo_url" value="{{ old('vice_photo_url', $psdmViceCard['photo_url'] ?? '') }}" placeholder="https://contoh.com/foto-wakil-kepala-divisi-psdm.jpg">
                            </div>
                        </article>

                        <h3 style="margin: 8px 0 10px; font-size: 0.98rem; color: #f2f2f2;">Daftar Staff</h3>
                        <div id="psdmStaffContainer">
                            @foreach ($psdmStaffCards as $index => $card)
                                <article class="card-item" data-card-index="{{ $index }}">
                                    <div class="card-item-head">
                                        <p class="card-item-title">Card Staff #{{ $index + 1 }}</p>
                                        <button type="button" class="btn btn-danger remove-psdm-card">Hapus Card</button>
                                    </div>

                                    <div class="field">
                                        <label>Nama Staff</label>
                                        <input type="text" name="staff_cards[{{ $index }}][name]" value="{{ $card['name'] ?? '' }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Jabatan</label>
                                        <input type="text" value="Staff" readonly>
                                    </div>

                                    <div class="field">
                                        <label>URL Foto Staff</label>
                                        <input type="url" name="staff_cards[{{ $index }}][photo_url]" value="{{ $card['photo_url'] ?? '' }}" placeholder="https://contoh.com/foto-staff-psdm.jpg">
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="save-row">
                            <button type="button" class="btn" id="addPsdmStaffCard">Tambah Card Staff</button>
                            <button class="btn btn-primary" type="submit">Simpan Card PSDM</button>
                        </div>
                    </form>
                </section>
            </section>

            <p class="hint">Perubahan yang disimpan di sini akan otomatis sinkron ke halaman user Ketum, Waketum, Sekben, Litbang, Manajemen Event, Manajemen Talent, Produksi, Rumah Tangga, dan PSDM.</p>

            <div class="actions">
                <a class="btn" href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">Logout</button>
                </form>
            </div>
        </section>
    </main>
    <footer class="site-footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>

    <script>
        (function () {
            var buttons = document.querySelectorAll('.switch-btn');
            var editors = document.querySelectorAll('.editor');

            for (var i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function () {
                    var target = this.getAttribute('data-target');

                    for (var b = 0; b < buttons.length; b++) {
                        buttons[b].classList.remove('active');
                    }

                    for (var e = 0; e < editors.length; e++) {
                        editors[e].classList.remove('active');
                    }

                    this.classList.add('active');
                    var editor = document.getElementById(target);

                    if (editor) {
                        editor.classList.add('active');
                    }
                });
            }

            function setupCardEditor(config) {
                var addButton = document.getElementById(config.addButtonId);
                var container = document.getElementById(config.containerId);

                if (!addButton || !container) {
                    return;
                }

                function bindRemoveButtons() {
                    var removeButtons = container.querySelectorAll(config.removeSelector);

                    for (var r = 0; r < removeButtons.length; r++) {
                        removeButtons[r].onclick = function () {
                            var cards = container.querySelectorAll('.card-item');

                            if (cards.length <= 1) {
                                return;
                            }

                            var item = this.closest('.card-item');

                            if (item) {
                                item.remove();
                                reindexCards();
                            }
                        };
                    }
                }

                function reindexCards() {
                    var cards = container.querySelectorAll('.card-item');

                    for (var i = 0; i < cards.length; i++) {
                        var title = cards[i].querySelector('.card-item-title');
                        var inputs = cards[i].querySelectorAll('input');

                        if (title) {
                            title.textContent = 'Card ' + config.label + ' #' + (i + 1);
                        }

                        for (var j = 0; j < inputs.length; j++) {
                            var nameAttr = inputs[j].getAttribute('name');

                            if (nameAttr) {
                                inputs[j].setAttribute('name', nameAttr.replace(/cards\[\d+\]/, 'cards[' + i + ']'));
                            }
                        }
                    }

                    bindRemoveButtons();
                }

                addButton.addEventListener('click', function () {
                    var currentCount = container.querySelectorAll('.card-item').length;
                    var newIndex = currentCount;
                    var wrapper = document.createElement('article');

                    wrapper.className = 'card-item';
                    wrapper.setAttribute('data-card-index', String(newIndex));
                    wrapper.innerHTML = '' +
                        '<div class="card-item-head">' +
                            '<p class="card-item-title">Card ' + config.label + ' #' + (newIndex + 1) + '</p>' +
                            '<button type="button" class="btn btn-danger ' + config.removeClass + '">Hapus Card</button>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>Nama ' + config.label + '</label>' +
                            '<input type="text" name="cards[' + newIndex + '][name]" required>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>Jabatan ' + config.label + '</label>' +
                            '<input type="text" name="cards[' + newIndex + '][position]" required>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>URL Foto ' + config.label + '</label>' +
                            '<input type="url" name="cards[' + newIndex + '][photo_url]" placeholder="https://contoh.com/foto-' + config.label.toLowerCase() + '.jpg">' +
                        '</div>';

                    container.appendChild(wrapper);
                    bindRemoveButtons();
                });

                bindRemoveButtons();
            }

            setupCardEditor({
                addButtonId: 'addWaketumCard',
                containerId: 'waketumCardsContainer',
                removeSelector: '.remove-waketum-card',
                removeClass: 'remove-waketum-card',
                label: 'Waketum'
            });

            setupCardEditor({
                addButtonId: 'addSekbenCard',
                containerId: 'sekbenCardsContainer',
                removeSelector: '.remove-sekben-card',
                removeClass: 'remove-sekben-card',
                label: 'Sekben'
            });

            setupCardEditor({
                addButtonId: 'addLitbangCard',
                containerId: 'litbangCardsContainer',
                removeSelector: '.remove-litbang-card',
                removeClass: 'remove-litbang-card',
                label: 'Litbang'
            });

            function setupStaffOnlyEditor(config) {
                var addButton = document.getElementById(config.addButtonId);
                var container = document.getElementById(config.containerId);

                if (!addButton || !container) {
                    return;
                }

                function bindRemoveButtons() {
                    var removeButtons = container.querySelectorAll(config.removeSelector);

                    for (var r = 0; r < removeButtons.length; r++) {
                        removeButtons[r].onclick = function () {
                            var item = this.closest('.card-item');

                            if (item) {
                                item.remove();
                                reindexCards();
                            }
                        };
                    }
                }

                function reindexCards() {
                    var cards = container.querySelectorAll('.card-item');

                    for (var i = 0; i < cards.length; i++) {
                        var title = cards[i].querySelector('.card-item-title');
                        var inputs = cards[i].querySelectorAll('input[name^="' + config.staffPrefix + '["]');

                        if (title) {
                            title.textContent = 'Card Staff #' + (i + 1);
                        }

                        for (var j = 0; j < inputs.length; j++) {
                            var nameAttr = inputs[j].getAttribute('name');

                            if (nameAttr) {
                                inputs[j].setAttribute('name', nameAttr.replace(config.staffRegex, config.staffPrefix + '[' + i + ']'));
                            }
                        }
                    }

                    bindRemoveButtons();
                }

                addButton.addEventListener('click', function () {
                    var newIndex = container.querySelectorAll('.card-item').length;
                    var wrapper = document.createElement('article');

                    wrapper.className = 'card-item';
                    wrapper.setAttribute('data-card-index', String(newIndex));
                    wrapper.innerHTML = '' +
                        '<div class="card-item-head">' +
                            '<p class="card-item-title">Card Staff #' + (newIndex + 1) + '</p>' +
                            '<button type="button" class="btn btn-danger ' + config.removeClass + '">Hapus Card</button>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>Nama Staff</label>' +
                            '<input type="text" name="' + config.staffPrefix + '[' + newIndex + '][name]" required>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>Jabatan</label>' +
                            '<input type="text" value="Staff" readonly>' +
                        '</div>' +
                        '<div class="field">' +
                            '<label>URL Foto Staff</label>' +
                            '<input type="url" name="' + config.staffPrefix + '[' + newIndex + '][photo_url]" placeholder="' + config.photoPlaceholder + '">' +
                        '</div>';

                    container.appendChild(wrapper);
                    bindRemoveButtons();
                });

                bindRemoveButtons();
            }

            setupStaffOnlyEditor({
                addButtonId: 'addManajemenEventStaffCard',
                containerId: 'manajemenEventStaffContainer',
                removeSelector: '.remove-manajemen-event-card',
                removeClass: 'remove-manajemen-event-card',
                staffPrefix: 'staff_cards',
                staffRegex: /staff_cards\[\d+\]/,
                photoPlaceholder: 'https://contoh.com/foto-staff-event.jpg'
            });

            setupStaffOnlyEditor({
                addButtonId: 'addManajemenTalentStaffCard',
                containerId: 'manajemenTalentStaffContainer',
                removeSelector: '.remove-manajemen-talent-card',
                removeClass: 'remove-manajemen-talent-card',
                staffPrefix: 'staff_cards',
                staffRegex: /staff_cards\[\d+\]/,
                photoPlaceholder: 'https://contoh.com/foto-staff-talent.jpg'
            });

            setupStaffOnlyEditor({
                addButtonId: 'addProduksiStaffCard',
                containerId: 'produksiStaffContainer',
                removeSelector: '.remove-produksi-card',
                removeClass: 'remove-produksi-card',
                staffPrefix: 'staff_cards',
                staffRegex: /staff_cards\[\d+\]/,
                photoPlaceholder: 'https://contoh.com/foto-staff-produksi.jpg'
            });

            setupStaffOnlyEditor({
                addButtonId: 'addRumahTanggaStaffCard',
                containerId: 'rumahTanggaStaffContainer',
                removeSelector: '.remove-rumah-tangga-card',
                removeClass: 'remove-rumah-tangga-card',
                staffPrefix: 'staff_cards',
                staffRegex: /staff_cards\[\d+\]/,
                photoPlaceholder: 'https://contoh.com/foto-staff-rumahtangga.jpg'
            });

            setupStaffOnlyEditor({
                addButtonId: 'addPsdmStaffCard',
                containerId: 'psdmStaffContainer',
                removeSelector: '.remove-psdm-card',
                removeClass: 'remove-psdm-card',
                staffPrefix: 'staff_cards',
                staffRegex: /staff_cards\[\d+\]/,
                photoPlaceholder: 'https://contoh.com/foto-staff-psdm.jpg'
            });
        })();
    </script>
</body>
</html>
