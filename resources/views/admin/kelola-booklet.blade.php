<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeband - Kelola Booklet</title>
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

        .btn-secondary {
            border-color: #5c5c5c;
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-secondary:hover {
            border-color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
        }

        .btn:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.2);
        }

        .field-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .cards-grid {
            display: grid;
            gap: 16px;
            margin-top: 12px;
        }

        .card-panel {
            border: 1px solid #3a3a3a;
            border-radius: 14px;
            padding: 16px;
            background: rgba(12, 12, 12, 0.9);
        }

        .card-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }

        .card-panel-header h2 {
            margin: 0;
            font-size: 1rem;
            color: #f5f5f5;
        }

        .card-panel .field {
            margin-bottom: 12px;
        }

        .card-panel input,
        .card-panel textarea {
            background: rgba(20, 20, 20, 0.95);
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
            <h1>Kelola Booklet</h1>
            <p>Perubahan pada halaman ini akan langsung tersinkron ke halaman Booklet pada user.</p>

            @if (session('status'))
                <p class="notice">{{ session('status') }}</p>
            @endif

            @if ($errors->any())
                <p class="validation">{{ $errors->first() }}</p>
            @endif

            <section class="form-block" aria-label="Form Kelola Booklet">
                @php
                    $bookletCards = old('cards', $booklet['cards'] ?? []);
                    if (!is_array($bookletCards)) {
                        $bookletCards = [];
                    }
                @endphp

                <form method="POST" action="{{ route('admin.kelola-booklet.update') }}">
                    @csrf

                    <div class="field">
                        <label for="booklet-title">Judul Halaman Booklet</label>
                        <input id="booklet-title" type="text" name="title" value="{{ old('title', $booklet['title'] ?? 'Booklet Profil Band') }}" required>
                    </div>

                    <div class="field">
                        <div class="field-row">
                            <p style="margin:0; font-weight:700; color:#fff;">Kartu Band</p>
                            <button type="button" class="btn btn-secondary" id="addCardBtn">Tambah Kartu Band</button>
                        </div>
                    </div>

                    <div class="cards-grid" id="bookletCardsContainer">
                        @forelse ($bookletCards as $index => $card)
                            <section class="card-panel" data-index="{{ $index }}">
                                <div class="card-panel-header">
                                    <h2>Band {{ $index + 1 }}</h2>
                                    <button type="button" class="btn btn-secondary remove-card-btn">Hapus</button>
                                </div>

                                <div class="field">
                                    <label for="card-name-{{ $index }}">Nama Band</label>
                                    <input id="card-name-{{ $index }}" type="text" name="cards[{{ $index }}][name]" value="{{ old('cards.' . $index . '.name', $card['name'] ?? '') }}" required>
                                </div>

                                <div class="field">
                                    <label for="card-photo-{{ $index }}">URL Foto Band</label>
                                    <input id="card-photo-{{ $index }}" type="url" name="cards[{{ $index }}][photo_url]" value="{{ old('cards.' . $index . '.photo_url', $card['photo_url'] ?? '') }}" placeholder="https://...">
                                </div>

                                <div class="field">
                                    <label for="card-desc-{{ $index }}">Deskripsi Band</label>
                                    <textarea id="card-desc-{{ $index }}" name="cards[{{ $index }}][description]" placeholder="Tuliskan deskripsi singkat band">{{ old('cards.' . $index . '.description', $card['description'] ?? '') }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="card-role-{{ $index }}">Role Band (poin-poin)</label>
                                    <textarea id="card-role-{{ $index }}" name="cards[{{ $index }}][role]" placeholder="Masukkan peran dalam setiap baris">{{ old('cards.' . $index . '.role', $card['role'] ?? '') }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="card-whatsapp-name-{{ $index }}">Nama Kontak WhatsApp</label>
                                    <input id="card-whatsapp-name-{{ $index }}" type="text" name="cards[{{ $index }}][whatsapp_name]" value="{{ old('cards.' . $index . '.whatsapp_name', $card['whatsapp_name'] ?? '') }}" placeholder="Misal: Admin Band">
                                </div>

                                <div class="field">
                                    <label for="card-whatsapp-link-{{ $index }}">Link WhatsApp</label>
                                    <input id="card-whatsapp-link-{{ $index }}" type="url" name="cards[{{ $index }}][whatsapp_link]" value="{{ old('cards.' . $index . '.whatsapp_link', $card['whatsapp_link'] ?? '') }}" placeholder="https://wa.me/628123...">
                                </div>
                            </section>
                        @empty
                            <section class="card-panel" data-index="0">
                                <div class="card-panel-header">
                                    <h2>Band 1</h2>
                                    <button type="button" class="btn btn-secondary remove-card-btn">Hapus</button>
                                </div>

                                <div class="field">
                                    <label for="card-name-0">Nama Band</label>
                                    <input id="card-name-0" type="text" name="cards[0][name]" value="" required>
                                </div>

                                <div class="field">
                                    <label for="card-photo-0">URL Foto Band</label>
                                    <input id="card-photo-0" type="url" name="cards[0][photo_url]" value="" placeholder="https://...">
                                </div>

                                <div class="field">
                                    <label for="card-desc-0">Deskripsi Band</label>
                                    <textarea id="card-desc-0" name="cards[0][description]" placeholder="Tuliskan deskripsi singkat band"></textarea>
                                </div>

                                <div class="field">
                                    <label for="card-role-0">Role Band (poin-poin)</label>
                                    <textarea id="card-role-0" name="cards[0][role]" placeholder="Masukkan peran dalam setiap baris"></textarea>
                                </div>

                                <div class="field">
                                    <label for="card-whatsapp-name-0">Nama Kontak WhatsApp</label>
                                    <input id="card-whatsapp-name-0" type="text" name="cards[0][whatsapp_name]" value="" placeholder="Misal: Admin Band">
                                </div>

                                <div class="field">
                                    <label for="card-whatsapp-link-0">Link WhatsApp</label>
                                    <input id="card-whatsapp-link-0" type="url" name="cards[0][whatsapp_link]" value="" placeholder="https://wa.me/628123...">
                                </div>
                            </section>
                        @endforelse
                    </div>

                    <div class="save-row">
                        <button class="btn btn-primary" type="submit">Simpan Booklet</button>
                        <a class="btn" href="{{ route('user.booklet-band') }}" target="_blank" rel="noopener">Lihat Halaman User</a>
                    </div>
                </form>
            </section>

            <template id="cardTemplate">
                <section class="card-panel" data-index="__INDEX__">
                    <div class="card-panel-header">
                        <h2>Band __NUMBER__</h2>
                        <button type="button" class="btn btn-secondary remove-card-btn">Hapus</button>
                    </div>

                    <div class="field">
                        <label for="card-name-__INDEX__">Nama Band</label>
                        <input id="card-name-__INDEX__" type="text" name="cards[__INDEX__][name]" value="" required>
                    </div>

                    <div class="field">
                        <label for="card-photo-__INDEX__">URL Foto Band</label>
                        <input id="card-photo-__INDEX__" type="url" name="cards[__INDEX__][photo_url]" value="" placeholder="https://...">
                    </div>

                    <div class="field">
                        <label for="card-desc-__INDEX__">Deskripsi Band</label>
                        <textarea id="card-desc-__INDEX__" name="cards[__INDEX__][description]" placeholder="Tuliskan deskripsi singkat band"></textarea>
                    </div>

                    <div class="field">
                        <label for="card-role-__INDEX__">Role Band (poin-poin)</label>
                        <textarea id="card-role-__INDEX__" name="cards[__INDEX__][role]" placeholder="Masukkan peran dalam setiap baris"></textarea>
                    </div>

                    <div class="field">
                        <label for="card-whatsapp-name-__INDEX__">Nama Kontak WhatsApp</label>
                        <input id="card-whatsapp-name-__INDEX__" type="text" name="cards[__INDEX__][whatsapp_name]" value="" placeholder="Misal: Admin Band">
                    </div>

                    <div class="field">
                        <label for="card-whatsapp-link-__INDEX__">Link WhatsApp</label>
                        <input id="card-whatsapp-link-__INDEX__" type="url" name="cards[__INDEX__][whatsapp_link]" value="" placeholder="https://wa.me/628123...">
                    </div>
                </section>
            </template>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.getElementById('bookletCardsContainer');
                    const template = document.getElementById('cardTemplate').innerHTML;
                    const addBtn = document.getElementById('addCardBtn');

                    function updateCardIndices() {
                        const cards = container.querySelectorAll('.card-panel');
                        cards.forEach((card, idx) => {
                            card.dataset.index = idx;
                            card.querySelector('h2').textContent = 'Band ' + (idx + 1);

                            card.querySelectorAll('label').forEach(label => {
                                const forAttr = label.getAttribute('for');
                                if (forAttr) {
                                    label.setAttribute('for', forAttr.replace(/cards\[\d+\]/, 'cards[' + idx + ']'));
                                }
                            });

                            card.querySelectorAll('input, textarea').forEach(field => {
                                const name = field.getAttribute('name');
                                if (name) {
                                    field.setAttribute('name', name.replace(/cards\[\d+\]/, 'cards[' + idx + ']'));
                                }
                                const id = field.getAttribute('id');
                                if (id) {
                                    field.setAttribute('id', id.replace(/-\d+$/, '-' + idx));
                                }
                            });
                        });
                    }

                    function addCard() {
                        const index = container.querySelectorAll('.card-panel').length;
                        const html = template.replace(/__INDEX__/g, index).replace(/__NUMBER__/g, index + 1);
                        container.insertAdjacentHTML('beforeend', html);
                        attachRemovers();
                        updateCardIndices();
                    }

                    function attachRemovers() {
                        container.querySelectorAll('.remove-card-btn').forEach(button => {
                            button.removeEventListener('click', onRemove);
                            button.addEventListener('click', onRemove);
                        });
                    }

                    function onRemove(event) {
                        const panel = event.currentTarget.closest('.card-panel');
                        if (panel) {
                            panel.remove();
                            updateCardIndices();
                        }
                    }

                    addBtn.addEventListener('click', addCard);
                    attachRemovers();
                });
            </script>

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
