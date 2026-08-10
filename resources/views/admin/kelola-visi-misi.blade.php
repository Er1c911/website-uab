<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Visi Misi</title>
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

        .form-block {
            border: 1px solid #353535;
            border-radius: 12px;
            padding: 12px;
            background: rgba(14, 14, 14, 0.65);
            margin-top: 16px;
        }

        .field {
            margin-bottom: 12px;
        }

        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .field-card {
            border: 1px solid #333;
            border-radius: 12px;
            padding: 12px;
            background: rgba(8, 8, 8, 0.75);
        }

        .field-card h2 {
            margin: 0 0 8px;
            font-size: 1rem;
            color: #fff;
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
            min-height: 150px;
            resize: vertical;
        }

        .save-row,
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .actions {
            margin-top: 18px;
        }

        .btn {
            text-decoration: none;
            border: 1px solid #4a4a4a;
            border-radius: 10px;
            padding: 9px 14px;
            color: #f5f5f5;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
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

        .site-footer {
            border-top: 1px solid #2d2d2d;
            text-align: center;
            padding: 14px 16px;
            color: #c7c7c7;
            font-size: 0.86rem;
            background: rgba(8, 8, 8, 0.9);
        }

        @media (max-width: 560px) {
            .container {
                padding: 16px 12px;
            }

            .panel {
                border-radius: 12px;
                padding: 14px;
            }

            .actions .btn,
            .save-row .btn {
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
            <h1>Kelola Visi Misi</h1>
            <p>Perubahan pada halaman ini akan langsung tersinkron ke halaman Visi Misi pada user.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <section class="form-block" aria-label="Form Kelola Visi Misi">
                <form method="POST" action="{{ route('admin.kelola-visi-misi.update') }}">
                    @csrf
                    <div class="field">
                        <label for="visi-title">Judul Halaman Visi Misi</label>
                        <input id="visi-title" type="text" name="title" value="{{ old('title', $visiMisi['title'] ?? 'Visi dan Misi Homeband') }}" required>
                    </div>

                    <div class="field-grid">
                        <div class="field-card">
                            <h2>Form Visi</h2>
                            <div class="field">
                                <label for="visi-vision">Isi Visi</label>
                                <textarea id="visi-vision" name="vision" required>{{ old('vision', $visiMisi['vision'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="field-card">
                            <h2>Form Misi</h2>
                            <div class="field">
                                <label for="visi-mission">Isi Misi</label>
                                <textarea id="visi-mission" name="mission" required>{{ old('mission', $visiMisi['mission'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="save-row">
                        <button class="btn btn-primary" type="submit">Simpan Visi Misi</button>
                        <a class="btn" href="{{ route('user.visi-misi') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                    </div>
                </form>
            </section>

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
</body>
</html>
