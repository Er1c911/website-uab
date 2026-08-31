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
            border: 1px solid rgba(217, 11, 28, 0.3);
            border-radius: 16px;
            padding: 24px;
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.8), rgba(30, 15, 15, 0.4));
            margin-top: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(217, 11, 28, 0.2);
        }

        .field { 
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: #e8e8e8;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .field input,
        .field textarea {
            width: 100%;
            border: 1.5px solid rgba(217, 11, 28, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            background: rgba(8, 8, 8, 0.7);
            color: #f5f5f5;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .field input:focus,
        .field textarea:focus {
            outline: none;
            border-color: var(--accent-strong);
            background: rgba(8, 8, 8, 0.9);
            box-shadow: 0 0 0 3px rgba(217, 11, 28, 0.15);
        }

        .field textarea {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .info-card-item {
            background: linear-gradient(135deg, rgba(25, 25, 25, 0.8), rgba(35, 20, 20, 0.4));
            border: 1.5px solid rgba(217, 11, 28, 0.25);
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .info-card-item:hover {
            border-color: rgba(217, 11, 28, 0.4);
            box-shadow: 0 8px 24px rgba(217, 11, 28, 0.15);
        }

        .links-section {
            border: 1.5px solid rgba(217, 11, 28, 0.15);
            border-radius: 12px;
            padding: 14px;
            background: linear-gradient(135deg, rgba(12, 12, 12, 0.6), rgba(25, 15, 15, 0.3));
            margin-top: 12px;
            transition: all 0.3s ease;
        }

        .links-section:hover {
            background: linear-gradient(135deg, rgba(15, 15, 15, 0.7), rgba(30, 15, 15, 0.4));
            border-color: rgba(217, 11, 28, 0.25);
        }

        .links-section p {
            margin: 0 0 12px;
            font-weight: 800;
            color: #ffb8bc;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .link-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            padding: 10px;
            background: rgba(8, 8, 8, 0.4);
            border-radius: 10px;
            border: 1px solid rgba(217, 11, 28, 0.1);
            transition: all 0.2s ease;
        }

        .link-item:hover {
            background: rgba(8, 8, 8, 0.6);
            border-color: rgba(217, 11, 28, 0.2);
        }

        .link-item > div {
            flex: 1;
        }

        .link-item input {
            width: 100%;
            border: 1px solid rgba(217, 11, 28, 0.15);
            border-radius: 8px;
            padding: 9px 12px;
            background: rgba(8, 8, 8, 0.5);
            color: #f5f5f5;
            font-family: inherit;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .link-item input:focus {
            outline: none;
            border-color: rgba(217, 11, 28, 0.4);
            background: rgba(8, 8, 8, 0.8);
        }

        .link-item .btn {
            padding: 8px 12px;
            white-space: nowrap;
            font-size: 0.85rem;
        }

        .btn-add-link {
            font-size: 0.85rem;
            padding: 8px 14px;
            margin-top: 8px;
            background: rgba(217, 11, 28, 0.1);
            border: 1.5px solid rgba(217, 11, 28, 0.3);
            transition: all 0.2s ease;
        }

        .btn-add-link:hover {
            background: rgba(217, 11, 28, 0.15);
            border-color: rgba(217, 11, 28, 0.5);
            transform: translateY(-2px);
        }

        .form-section-title {
            margin: 0 0 14px;
            font-weight: 800;
            color: #fff;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 18px;
            background: linear-gradient(180deg, var(--accent), var(--accent-strong));
            border-radius: 2px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(217, 11, 28, 0.2);
        }

        .btn {
            text-decoration: none;
            border: 1.5px solid rgba(217, 11, 28, 0.3);
            border-radius: 10px;
            padding: 11px 18px;
            color: #f5f5f5;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn:hover {
            border-color: var(--accent-strong);
            background: rgba(217, 11, 28, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(217, 11, 28, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            border-color: transparent;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            color: #fff;
            box-shadow: 0 4px 16px rgba(217, 11, 28, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff2b41, #ff4050);
            box-shadow: 0 8px 24px rgba(217, 11, 28, 0.4);
            transform: translateY(-3px);
        }

        .add-card-btn {
            background: rgba(217, 11, 28, 0.12);
            border-color: rgba(217, 11, 28, 0.4);
            font-size: 0.9rem;
            padding: 10px 16px;
        }

        .add-card-btn:hover {
            background: rgba(217, 11, 28, 0.2);
            border-color: var(--accent-strong);
        }

        .remove-card-btn,
        .remove-link-btn {
            background: rgba(217, 11, 28, 0.15);
            border-color: rgba(217, 11, 28, 0.3);
            padding: 7px 10px;
            font-size: 0.8rem;
        }

        .remove-card-btn:hover,
        .remove-link-btn:hover {
            background: rgba(217, 11, 28, 0.3);
            border-color: var(--accent-strong);
        }

        .notice {
            margin-top: 14px;
            border: 1.5px solid rgba(255, 43, 65, 0.4);
            border-radius: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, rgba(217, 11, 28, 0.2), rgba(217, 11, 28, 0.1));
            color: #ffd8dd;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(217, 11, 28, 0.15);
        }

        .validation {
            margin-top: 14px;
            border: 1.5px solid rgba(245, 158, 11, 0.4);
            border-radius: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
            color: #fde68a;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
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
                        <p class="form-section-title">Daftar Card Informasi</p>
                        <button type="button" class="btn add-card-btn" id="addCardBtn">+ Tambah Card Informasi</button>
                    </div>

                    <div id="cardsList">
                        @foreach ($cards as $index => $card)
                            <div class="info-card-item" data-index="{{ $index }}">
                                <div style="display:grid; gap:10px;">
                                    <input type="text" name="cards[{{ $index }}][title]" value="{{ old('cards.' . $index . '.title', $card['title'] ?? '') }}" placeholder="Judul Informasi">
                                    <input type="url" name="cards[{{ $index }}][image_url]" value="{{ old('cards.' . $index . '.image_url', $card['image_url'] ?? '') }}" placeholder="URL Gambar Informasi (opsional)">
                                    <textarea name="cards[{{ $index }}][description]" placeholder="Deskripsi informasi">{{ old('cards.' . $index . '.description', $card['description'] ?? '') }}</textarea>
                                    
                                    <!-- Links Section -->
                                    <div class="links-section">
                                        <p>Link Eksternal (Opsional)</p>
                                        <div class="links-list" data-card-index="{{ $index }}" data-type="links">
                                            @php
                                                $links = old('cards.' . $index . '.links', $card['links'] ?? []);
                                                if (!is_array($links)) { $links = []; }
                                            @endphp
                                            @foreach ($links as $linkIndex => $link)
                                                <div class="link-item">
                                                    <div style="display: grid; gap: 6px;">
                                                        <input type="text" name="cards[{{ $index }}][links][{{ $linkIndex }}][name]" value="{{ $link['name'] ?? '' }}" placeholder="Nama Link (cth: Website Resmi)">
                                                        <input type="url" name="cards[{{ $index }}][links][{{ $linkIndex }}][url]" value="{{ $link['url'] ?? '' }}" placeholder="Masukkan URL">
                                                    </div>
                                                    <button type="button" class="btn remove-link-btn">Hapus</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-add-link add-link-btn" data-card-index="{{ $index }}" data-type="links">+ Tambah Link</button>
                                    </div>

                                    <!-- WhatsApp Section -->
                                    <div class="links-section">
                                        <p>Link WhatsApp (Opsional)</p>
                                        <div class="whatsapp-list" data-card-index="{{ $index }}" data-type="whatsapp">
                                            @php
                                                $whatsappLinks = old('cards.' . $index . '.whatsapp_links', $card['whatsapp_links'] ?? []);
                                                if (!is_array($whatsappLinks)) { $whatsappLinks = []; }
                                            @endphp
                                            @foreach ($whatsappLinks as $waIndex => $waLink)
                                                <div class="link-item">
                                                    <div style="display: grid; gap: 6px;">
                                                        <input type="text" name="cards[{{ $index }}][whatsapp_links][{{ $waIndex }}][name]" value="{{ $waLink['name'] ?? '' }}" placeholder="Nama Kontak (cth: Admin, Support)">
                                                        <input type="text" name="cards[{{ $index }}][whatsapp_links][{{ $waIndex }}][link]" value="{{ $waLink['link'] ?? '' }}" placeholder="Masukkan nomor atau URL (cth: 62812345678 atau https://wa.me/62812345678)">
                                                    </div>
                                                    <button type="button" class="btn remove-link-btn">Hapus</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-add-link add-link-btn" data-card-index="{{ $index }}" data-type="whatsapp">+ Tambah WhatsApp</button>
                                    </div>

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
                                    
                                    <!-- Links Section -->
                                    <div class="links-section">
                                        <p>Link Eksternal (Opsional)</p>
                                        <div class="links-list" data-card-index="0" data-type="links"></div>
                                        <button type="button" class="btn btn-add-link add-link-btn" data-card-index="0" data-type="links">+ Tambah Link</button>
                                    </div>

                                    <!-- WhatsApp Section -->
                                    <div class="links-section">
                                        <p>Link WhatsApp (Opsional)</p>
                                        <div class="whatsapp-list" data-card-index="0" data-type="whatsapp"></div>
                                        <button type="button" class="btn btn-add-link add-link-btn" data-card-index="0" data-type="whatsapp">+ Tambah WhatsApp</button>
                                    </div>

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
                                
                                <!-- Links Section -->
                                <div class="links-section">
                                    <p>Link Eksternal (Opsional)</p>
                                    <div class="links-list" data-card-index="__INDEX__" data-type="links"></div>
                                    <button type="button" class="btn btn-add-link add-link-btn" data-card-index="__INDEX__" data-type="links">+ Tambah Link</button>
                                </div>

                                <!-- WhatsApp Section -->
                                <div class="links-section">
                                    <p>Link WhatsApp (Opsional)</p>
                                    <div class="whatsapp-list" data-card-index="__INDEX__" data-type="whatsapp"></div>
                                    <button type="button" class="btn btn-add-link add-link-btn" data-card-index="__INDEX__" data-type="whatsapp">+ Tambah WhatsApp</button>
                                </div>

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
                            item.querySelectorAll('input[name^="cards"], textarea[name^="cards"]').forEach(input => {
                                const name = input.getAttribute('name');
                                if (!name) return;
                                input.setAttribute('name', name.replace(/cards\[\d+\]/, 'cards[' + index + ']'));
                            });

                            // Update link indices
                            updateLinkIndices(item, index, 'links');
                            updateLinkIndices(item, index, 'whatsapp');
                        });
                    }

                    function updateLinkIndices(cardItem, cardIndex, type) {
                        const container = type === 'links' 
                            ? cardItem.querySelector('.links-list')
                            : cardItem.querySelector('.whatsapp-list');
                        
                        if (!container) return;

                        container.querySelectorAll('.link-item').forEach((item, linkIndex) => {
                            const inputs = item.querySelectorAll('input');
                            const fieldName = type === 'links' ? 'links' : 'whatsapp_links';
                            inputs.forEach((input, inputIndex) => {
                                const subField = inputIndex === 0 ? 'name' : (type === 'links' ? 'url' : 'link');
                                input.setAttribute('name', `cards[${cardIndex}][${fieldName}][${linkIndex}][${subField}]`);
                            });
                        });
                    }

                    function attachLinkEventListeners(cardItem) {
                        // Add link button
                        const addLinkButtons = cardItem.querySelectorAll('.add-link-btn');
                        addLinkButtons.forEach(btn => {
                            btn.addEventListener('click', function (e) {
                                e.preventDefault();
                                const cardIndex = this.dataset.cardIndex;
                                const type = this.dataset.type;
                                const container = type === 'links'
                                    ? cardItem.querySelector('.links-list')
                                    : cardItem.querySelector('.whatsapp-list');
                                
                                if (!container) return;

                                const currentCount = container.querySelectorAll('.link-item').length;
                                const fieldName = type === 'links' ? 'links' : 'whatsapp_links';
                                const namePlaceholder = type === 'links' 
                                    ? 'Nama Link (cth: Website Resmi)'
                                    : 'Nama Kontak (cth: Admin, Support)';
                                const urlPlaceholder = type === 'links' 
                                    ? 'Masukkan URL'
                                    : 'Masukkan nomor atau URL (cth: 62812345678 atau https://wa.me/62812345678)';
                                const urlField = type === 'links' ? 'url' : 'link';

                                const linkItem = document.createElement('div');
                                linkItem.className = 'link-item';
                                linkItem.innerHTML = `
                                    <div style="display: grid; gap: 6px;">
                                        <input type="text" name="cards[${cardIndex}][${fieldName}][${currentCount}][name]" value="" placeholder="${namePlaceholder}">
                                        <input type="text" name="cards[${cardIndex}][${fieldName}][${currentCount}][${urlField}]" value="" placeholder="${urlPlaceholder}">
                                    </div>
                                    <button type="button" class="btn remove-link-btn">Hapus</button>
                                `;
                                container.appendChild(linkItem);
                            });
                        });

                        // Remove link button
                        const removeLinkButtons = cardItem.querySelectorAll('.remove-link-btn');
                        removeLinkButtons.forEach(btn => {
                            btn.addEventListener('click', function (e) {
                                e.preventDefault();
                                const linkItem = this.closest('.link-item');
                                if (linkItem) {
                                    linkItem.remove();
                                }
                            });
                        });
                    }

                    addCardBtn.addEventListener('click', function () {
                        const currentCount = cardsList.querySelectorAll('.info-card-item').length;
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = template.replace(/__INDEX__/g, currentCount);
                        const newCard = wrapper.firstElementChild;
                        cardsList.appendChild(newCard);
                        attachLinkEventListeners(newCard);
                    });

                    cardsList.addEventListener('click', function (event) {
                        const button = event.target.closest('.remove-card-btn');
                        if (!button) return;

                        const currentCard = button.closest('.info-card-item');
                        if (!currentCard) return;

                        const cards = Array.from(cardsList.querySelectorAll('.info-card-item'));
                        if (cards.length <= 1) {
                            currentCard.querySelectorAll('input[name^="cards"], textarea[name^="cards"]').forEach(input => {
                                input.value = '';
                            });
                            // Clear links
                            currentCard.querySelectorAll('.links-list, .whatsapp-list').forEach(container => {
                                container.querySelectorAll('.link-item').forEach(item => item.remove());
                            });
                            updateIndices();
                            return;
                        }

                        currentCard.remove();
                        updateIndices();
                    });

                    // Attach listeners to existing link buttons
                    cardsList.querySelectorAll('.info-card-item').forEach(card => {
                        attachLinkEventListeners(card);
                    });
                });
            </script>
        </section>
    </main>
</body>
</html>
