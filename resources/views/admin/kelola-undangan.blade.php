<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Undangan</title>
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
            min-height: 140px;
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

        .image-list {
            display: grid;
            gap: 10px;
            margin-top: 8px;
        }

        .image-item {
            border: 1px solid #3a3a3a;
            border-radius: 10px;
            padding: 12px;
            background: rgba(12, 12, 12, 0.9);
            display: grid;
            gap: 10px;
        }

        .image-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            align-items: center;
        }

        .remove-image-btn {
            min-width: 110px;
            border-color: #7a1c22;
            background: rgba(217, 11, 28, 0.12);
        }

        .remove-image-btn:hover {
            border-color: #ff2b41;
            background: rgba(217, 11, 28, 0.25);
        }

        .add-image-btn {
            border-color: #2d7a31;
            background: rgba(37, 211, 102, 0.12);
        }

        .add-image-btn:hover {
            border-color: #25d366;
            background: rgba(37, 211, 102, 0.22);
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
            <h1>Kelola Undangan</h1>
            <p>Perubahan pada halaman ini akan langsung tersinkron ke halaman Undangan &amp; Media Partner pada user.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <section class="form-block" aria-label="Form Kelola Undangan">
                @php
                    $images = old('images', $undangan['images'] ?? []);
                    if (!is_array($images)) {
                        $images = [];
                    }
                @endphp

                <form method="POST" action="{{ route('admin.kelola-undangan.update') }}">
                    @csrf

                    <div class="field">
                        <label for="undangan-title">Judul Halaman Undangan</label>
                        <input id="undangan-title" type="text" name="title" value="{{ old('title', $undangan['title'] ?? 'Undangan dan Media Partner') }}" required>
                    </div>

                    <div class="field">
                        <label for="undangan-whatsapp-name">Nama WhatsApp</label>
                        <input id="undangan-whatsapp-name" type="text" name="whatsapp_name" value="{{ old('whatsapp_name', $undangan['whatsapp_name'] ?? '') }}" placeholder="Contoh: Hubungi WhatsApp">
                    </div>

                    <div class="field">
                        <label for="undangan-whatsapp-link">Link WhatsApp</label>
                        <input id="undangan-whatsapp-link" type="url" name="whatsapp_link" value="{{ old('whatsapp_link', $undangan['whatsapp_link'] ?? '') }}" placeholder="https://wa.me/628...">
                    </div>

                    <div class="field">
                        <div class="field-row">
                            <p style="margin:0; font-weight:700; color:#fff;">URL Gambar</p>
                            <button type="button" class="btn add-image-btn" id="addImageBtn">Tambah Gambar</button>
                        </div>
                    </div>

                    <div class="image-list" id="imageList">
                        @foreach ($images as $index => $url)
                            <div class="image-item" data-index="{{ $index }}">
                                <div class="image-row">
                                    <input type="url" name="images[{{ $index }}]" value="{{ old('images.' . $index, $url) }}" placeholder="https://...">
                                    <button type="button" class="btn remove-image-btn">Hapus</button>
                                </div>
                            </div>
                        @endforeach

                        @if (count($images) === 0)
                            <div class="image-item" data-index="0">
                                <div class="image-row">
                                    <input type="url" name="images[0]" value="" placeholder="https://...">
                                    <button type="button" class="btn remove-image-btn">Hapus</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="actions">
                        <button class="btn btn-primary" type="submit">Simpan Undangan</button>
                        <a class="btn" href="{{ route('user.undangan-media-partner') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                        <a class="btn" href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
                    </div>
                </form>

                <template id="imageTemplate">
                    <div class="image-item" data-index="__INDEX__">
                        <div class="image-row">
                            <input type="url" name="images[__INDEX__]" value="" placeholder="https://...">
                            <button type="button" class="btn remove-image-btn">Hapus</button>
                        </div>
                    </div>
                </template>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const imageList = document.getElementById('imageList');
                        const addImageBtn = document.getElementById('addImageBtn');
                        const template = document.getElementById('imageTemplate').innerHTML;

                        function updateIndices() {
                            imageList.querySelectorAll('.image-item').forEach((item, index) => {
                                item.dataset.index = index;
                                const input = item.querySelector('input[type="url"]');
                                input.name = 'images[' + index + ']';
                            });
                        }

                        function attachRemoveButtons() {
                            imageList.querySelectorAll('.remove-image-btn').forEach(button => {
                                button.removeEventListener('click', onRemove);
                                button.addEventListener('click', onRemove);
                            });
                        }

                        function onRemove(event) {
                            const item = event.currentTarget.closest('.image-item');
                            if (!item) {
                                return;
                            }
                            item.remove();
                            if (imageList.children.length === 0) {
                                addImage();
                            } else {
                                updateIndices();
                            }
                        }

                        function addImage() {
                            const index = imageList.querySelectorAll('.image-item').length;
                            const html = template.replace(/__INDEX__/g, index);
                            imageList.insertAdjacentHTML('beforeend', html);
                            attachRemoveButtons();
                            updateIndices();
                        }

                        addImageBtn.addEventListener('click', addImage);
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
