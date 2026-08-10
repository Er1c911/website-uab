<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Dashboard Admin</title>
    <style>
        :root {
            --bg: #060606;
            --surface: #111111;
            --surface-2: #161616;
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

        .topbar {
            border: 1px solid var(--line);
            background: rgba(16, 16, 16, 0.88);
            border-radius: 16px;
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
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
            margin: 8px 0 0;
            font-size: clamp(1.5rem, 4vw, 2.2rem);
        }

        .sub {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .logout-btn {
            border: 0;
            border-radius: 10px;
            padding: 10px 15px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
        }

        .logout-btn:hover {
            filter: brightness(1.1);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .outside-actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            flex-wrap: wrap;
        }

        .manage-btn {
            text-decoration: none;
            border: 1px solid #4a4a4a;
            border-radius: 10px;
            padding: 9px 14px;
            color: #f5f5f5;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
        }

        .manage-btn:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.2);
        }

        @media (max-width: 560px) {
            .container {
                padding: 16px 12px;
            }

            .topbar {
                padding: 14px;
                border-radius: 12px;
            }

            .logout-btn {
                width: 100%;
            }

            .actions {
                width: 100%;
            }

            .outside-actions {
                justify-content: stretch;
            }

            .manage-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <header class="topbar">
            <div>
                <p class="tag">Admin Panel</p>
                <h1>Dashboard Admin</h1>
                <p class="sub">Anda berhasil login sebagai admin.</p>
            </div>

            <div class="actions">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            </div>
        </header>

        <div class="outside-actions">
            <a class="manage-btn" href="{{ route('admin.kelola-pengurus') }}">Kelola Pengurus</a>
            <a class="manage-btn" href="{{ route('admin.kelola-visi-misi') }}">Kelola Visi Misi</a>
            <a class="manage-btn" href="{{ route('admin.kelola-lokasi') }}">Kelola Lokasi</a>
            <a class="manage-btn" href="{{ route('admin.kelola-penyewaan') }}">Kelola Penyewaan</a>
            <a class="manage-btn" href="{{ route('admin.kelola-booklet') }}">Kelola Booklet</a>
            <a class="manage-btn" href="{{ route('admin.kelola-undangan') }}">Kelola Undangan</a>
            <a class="manage-btn" href="{{ route('admin.kelola-rilisan') }}">Kelola Rilisan</a>
        </div>
    </main>
    <footer class="site-footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>
</body>
</html>