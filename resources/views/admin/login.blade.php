<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Login Admin</title>
    <style>
        :root {
            --bg: #040404;
            --card: #0f0f0f;
            --text: #f5f5f5;
            --muted: #b1b1b1;
            --line: #2a2a2a;
            --accent: #d80b1d;
            --accent-strong: #ff2940;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 18px;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 20%, rgba(216, 11, 29, 0.22), transparent 38%),
                radial-gradient(circle at 90% 10%, rgba(216, 11, 29, 0.18), transparent 30%),
                linear-gradient(140deg, #020202 0%, #121212 100%);
            display: flex;
            flex-direction: column;
        }

        .page-center {
            flex: 1;
            display: grid;
            place-items: center;
        }

        .card {
            width: min(460px, 100%);
            border: 1px solid var(--line);
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(16, 16, 16, 0.96), rgba(10, 10, 10, 0.96));
            padding: 28px;
            box-shadow: 0 26px 54px rgba(0, 0, 0, 0.52);
        }

        .eyebrow {
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--accent-strong);
            font-size: 0.72rem;
            font-weight: 700;
        }

        h1 {
            margin: 10px 0 6px;
            font-size: clamp(1.45rem, 4.5vw, 1.95rem);
        }

        .sub {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .error {
            margin: 0 0 14px;
            border: 1px solid rgba(255, 41, 64, 0.45);
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(216, 11, 29, 0.13);
            color: #ffd4d9;
            font-size: 0.9rem;
        }

        .row {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #ededed;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            border: 1px solid #383838;
            border-radius: 10px;
            padding: 11px 12px;
            background: var(--bg);
            color: var(--text);
            font-size: 0.95rem;
        }

        input:focus {
            outline: none;
            border-color: var(--accent-strong);
            box-shadow: 0 0 0 3px rgba(255, 41, 64, 0.2);
        }

        button {
            width: 100%;
            margin-top: 8px;
            border: 0;
            border-radius: 10px;
            padding: 11px 12px;
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
        }

        button:hover {
            filter: brightness(1.1);
        }

        .link {
            margin-top: 14px;
            text-align: center;
            font-size: 0.9rem;
        }

        .link a {
            color: #ff8290;
            text-decoration: none;
        }

        .site-footer {
            border-top: 1px solid #2d2d2d;
            text-align: center;
            padding: 14px 16px;
            color: #c7c7c7;
            font-size: 0.86rem;
            background: rgba(8, 8, 8, 0.9);
            margin: 0 -18px -18px;
        }

        @media (max-width: 520px) {
            body {
                padding: 12px;
            }

            .card {
                padding: 22px 16px;
                border-radius: 14px;
            }

            .sub {
                font-size: 0.9rem;
            }

            .site-footer {
                margin: 0 -12px -12px;
            }
        }
    </style>
</head>
<body>
    <div class="page-center">
        <main class="card">
            <p class="eyebrow">Admin Portal</p>
            <h1>Login Admin</h1>
            <p class="sub">Gunakan username dan password admin untuk mengakses dashboard.</p>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="row">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required>
                </div>

                <div class="row">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>

                <button type="submit">Masuk</button>
            </form>

            <p class="link"><a href="{{ route('user.home') }}">Kembali ke halaman user</a></p>
        </main>
    </div>
    <footer class="site-footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>
</body>
</html>