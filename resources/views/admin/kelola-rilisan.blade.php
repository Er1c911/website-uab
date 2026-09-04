<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Rilisan</title>
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
            min-height: 180px;
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
            <h1>Kelola Rilisan</h1>
            <p>Perubahan pada halaman ini akan langsung tersinkron ke halaman Rilisan pada user.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <section class="form-block" aria-label="Form Kelola Rilisan">
                @php
                    $items = old('items', $rilisan['items'] ?? []);
                    if (!is_array($items)) { $items = []; }
                @endphp

                <form method="POST" action="{{ route('admin.kelola-rilisan.update') }}">
                    @csrf

                    <div class="field">
                        <label for="rilisan-title">Judul Halaman Rilisan</label>
                        <input id="rilisan-title" type="text" name="title" value="{{ old('title', $rilisan['title'] ?? 'Rilisan Terbaru') }}" required>
                    </div>

                    <div class="field">
                        <p style="margin:0; font-weight:700; color:#fff;">Daftar Rilisan</p>
                        <button type="button" class="btn add-item-btn" id="addItemBtn">Tambah Rilisan</button>
                    </div>

                    <div id="itemsList">
                        @foreach ($items as $index => $item)
                            <div class="image-item" data-index="{{ $index }}">
                                <div style="display:grid; gap:10px;">
                                    <input type="text" name="items[{{ $index }}][title]" value="{{ old('items.' . $index . '.title', $item['title'] ?? '') }}" placeholder="Nama Lagu (wajib)" required>
                                    <input type="url" name="items[{{ $index }}][image_url]" value="{{ old('items.' . $index . '.image_url', $item['image_url'] ?? '') }}" placeholder="URL Cover Gambar Lagu (opsional)">
                                    <input type="url" name="items[{{ $index }}][audio_url]" value="{{ old('items.' . $index . '.audio_url', $item['audio_url'] ?? '') }}" placeholder="URL Audio Lagu (opsional)">
                                    <input type="text" name="items[{{ $index }}][artist]" value="{{ old('items.' . $index . '.artist', $item['artist'] ?? '') }}" placeholder="Nama Band (wajib)" required>
                                    <div style="text-align:right;"><button type="button" class="btn remove-item-btn">Hapus</button></div>
                                </div>
                            </div>
                        @endforeach

                        @if (count($items) === 0)
                            <div class="image-item" data-index="0">
                                <div style="display:grid; gap:10px;">
                                    <input type="text" name="items[0][title]" value="" placeholder="Nama Lagu (wajib)" required>
                                    <input type="url" name="items[0][image_url]" value="" placeholder="URL Cover Gambar Lagu (opsional)">
                                    <input type="url" name="items[0][audio_url]" value="" placeholder="URL Audio Lagu (opsional)">
                                    <input type="text" name="items[0][artist]" value="" placeholder="Nama Band (wajib)" required>
                                    <div style="text-align:right;"><button type="button" class="btn remove-item-btn">Hapus</button></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <template id="itemTemplate">
                        <div class="image-item" data-index="__INDEX__">
                            <div style="display:grid; gap:10px;">
                                <input type="text" name="items[__INDEX__][title]" value="" placeholder="Nama Lagu (wajib)" required>
                                <input type="url" name="items[__INDEX__][image_url]" value="" placeholder="URL Cover Gambar Lagu (opsional)">
                                <input type="url" name="items[__INDEX__][audio_url]" value="" placeholder="URL Audio Lagu (opsional)">
                                <input type="text" name="items[__INDEX__][artist]" value="" placeholder="Nama Band (wajib)" required>
                                <div style="text-align:right;"><button type="button" class="btn remove-item-btn">Hapus</button></div>
                            </div>
                        </div>
                    </template>

                    <div class="actions">
                        <button class="btn btn-primary" type="submit">Simpan Rilisan</button>
                        <a class="btn" href="{{ route('user.rilisan') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        <a class="btn" href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const itemsList = document.getElementById('itemsList');
                        const addItemBtn = document.getElementById('addItemBtn');
                        const template = document.getElementById('itemTemplate').innerHTML;

                        function updateIndices() {
                            itemsList.querySelectorAll('.image-item').forEach((item, index) => {
                                item.dataset.index = index;
                                item.querySelectorAll('input, textarea').forEach(input => {
                                    const name = input.name.replace(/items\[\d+\]/, 'items[' + index + ']');
                                    input.name = name;
                                });
                            });
                        }

                        function attachRemoveButtons() {
                            itemsList.querySelectorAll('.remove-item-btn').forEach(button => {
                                button.removeEventListener('click', onRemove);
                                button.addEventListener('click', onRemove);
                            });
                        }

                        function onRemove(event) {
                            const item = event.currentTarget.closest('.image-item');
                            if (!item) return;
                            item.remove();
                            if (itemsList.children.length === 0) {
                                addItem();
                            } else {
                                updateIndices();
                            }
                        }

                        function addItem() {
                            const index = itemsList.querySelectorAll('.image-item').length;
                            const html = template.replace(/__INDEX__/g, index);
                            itemsList.insertAdjacentHTML('beforeend', html);
                            attachRemoveButtons();
                            updateIndices();
                        }

                        addItemBtn.addEventListener('click', addItem);
                        attachRemoveButtons();
                    });
                </script>
            </section>
        </section>
    </main>
    <footer class="site-footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>
</body>
</html>
