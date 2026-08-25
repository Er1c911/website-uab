<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Informasi</title>
    <style>
        :root {
            --line: #292929;
            --text: #f4f4f4;
            --muted: #b8b8b8;
            --accent: #d90b1c;
            --accent-strong: #ff2b41;
        }

        * { box-sizing: border-box; }

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

        .field { margin-bottom: 12px; }

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
            min-height: 220px;
            resize: vertical;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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
            .container { padding: 16px 12px; }
            .panel { border-radius: 12px; padding: 14px; }
            .actions .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="panel">
            <p class="tag">Admin Panel</p>
            <h1>Kelola Informasi</h1>
            <p>Perubahan pada halaman ini akan langsung tersinkron ke halaman Informasi pada user.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <section class="form-block" aria-label="Form Kelola Informasi">
                @php
                    $cards = old('cards', $informasi['cards'] ?? []);
                    if (!is_array($cards)) { $cards = []; }
                @endphp

                <form method="POST" action="{{ route('admin.kelola-informasi.update') }}">
                    @csrf

                    <div class="field">
                        <label for="informasi-title">Judul Halaman Informasi</label>
                        <input id="informasi-title" type="text" name="title" value="{{ old('title', $informasi['title'] ?? 'Pusat Informasi') }}" required>
                    </div>

                    <div class="field">
                        <p style="margin:0; font-weight:700; color:#fff;">Daftar Card Informasi</p>
                        <button type="button" class="btn add-card-btn" id="addCardBtn">Tambah Card Informasi</button>
                    </div>

                    <div id="cardsList">
                        @foreach ($cards as $index => $card)
                            <div class="info-card-item" data-index="{{ $index }}">
                                <div style="display:grid; gap:10px;">
                                    <input type="text" name="cards[{{ $index }}][title]" value="{{ old('cards.' . $index . '.title', $card['title'] ?? '') }}" placeholder="Judul Informasi">
                                    <input type="url" name="cards[{{ $index }}][image_url]" value="{{ old('cards.' . $index . '.image_url', $card['image_url'] ?? '') }}" placeholder="URL Gambar Informasi (opsional)">
                                    <textarea name="cards[{{ $index }}][description]" placeholder="Deskripsi informasi">{{ old('cards.' . $index . '.description', $card['description'] ?? '') }}</textarea>
                                    <div style="text-align:right;"><button type="button" class="btn remove-card-btn">Hapus</button></div>
                                </div>
                            </div>
                        @endforeach

                        @if (count($cards) === 0)
                            <div class="info-card-item" data-index="0">
                                <div style="display:grid; gap:10px;">
                                    <input type="text" name="cards[0][title]" value="" placeholder="Judul Informasi">
                                    <input type="url" name="cards[0][image_url]" value="" placeholder="URL Gambar Informasi (opsional)">
                                    <textarea name="cards[0][description]" placeholder="Deskripsi informasi"></textarea>
                                    <div style="text-align:right;"><button type="button" class="btn remove-card-btn">Hapus</button></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <template id="cardTemplate">
                        <div class="info-card-item" data-index="__INDEX__">
                            <div style="display:grid; gap:10px;">
                                <input type="text" name="cards[__INDEX__][title]" value="" placeholder="Judul Informasi">
                                <input type="url" name="cards[__INDEX__][image_url]" value="" placeholder="URL Gambar Informasi (opsional)">
                                <textarea name="cards[__INDEX__][description]" placeholder="Deskripsi informasi"></textarea>
                                <div style="text-align:right;"><button type="button" class="btn remove-card-btn">Hapus</button></div>
                            </div>
                        </div>
                    </template>

                    <div class="actions">
                        <button class="btn btn-primary" type="submit">Simpan Informasi</button>
                        <a class="btn" href="{{ route('user.informasi') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        <a class="btn" href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
                    </div>
                </form>
            </section>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const cardsList = document.getElementById('cardsList');
                    const addCardBtn = document.getElementById('addCardBtn');
                    const template = document.getElementById('cardTemplate').innerHTML;

                    function updateIndices() {
                        cardsList.querySelectorAll('.info-card-item').forEach((item, index) => {
                            item.dataset.index = index;
                            item.querySelectorAll('input, textarea').forEach(input => {
                                const name = input.getAttribute('name');
                                if (!name) return;
                                input.setAttribute('name', name.replace(/cards\[\d+\]/, 'cards[' + index + ']'));
                            });
                        });
                    }

                    addCardBtn.addEventListener('click', function () {
                        const currentCount = cardsList.querySelectorAll('.info-card-item').length;
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = template.replace(/__INDEX__/g, currentCount);
                        cardsList.appendChild(wrapper.firstElementChild);
                    });

                    cardsList.addEventListener('click', function (event) {
                        const button = event.target.closest('.remove-card-btn');
                        if (!button) return;

                        const currentCard = button.closest('.info-card-item');
                        if (!currentCard) return;

                        const cards = Array.from(cardsList.querySelectorAll('.info-card-item'));
                        if (cards.length <= 1) {
                            currentCard.querySelectorAll('input, textarea').forEach(input => {
                                input.value = '';
                            });
                            updateIndices();
                            return;
                        }

                        currentCard.remove();
                        updateIndices();
                    });
                });
            </script>
        </section>
    </main>
</body>
</html>
