<?php

namespace App\Http\Controllers;

use App\Support\PengurusProfileStore;
use App\Support\SitePageStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(
        private PengurusProfileStore $pengurusProfileStore,
        private SitePageStore $sitePageStore
    )
    {
    }

    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function kelolaPengurus(): View
    {
        return view('admin.kelola-pengurus', [
            'profiles' => $this->pengurusProfileStore->all(),
        ]);
    }

    public function kelolaVisiMisi(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-visi-misi', [
            'visiMisi' => $sitePages['visi-misi'] ?? [
                'title' => 'Visi dan Misi Homeband',
                'vision' => '',
                'mission' => '',
            ],
        ]);
    }

    public function updateVisiMisi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'vision' => ['nullable', 'string', 'max:5000'],
            'mission' => ['nullable', 'string', 'max:5000'],
        ]);

        $this->sitePageStore->update('visi-misi', [
            'title' => $validated['title'],
            'vision' => $validated['vision'] ?? '',
            'mission' => $validated['mission'] ?? '',
        ]);

        return redirect()
            ->route('admin.kelola-visi-misi')
            ->with('status', 'Halaman Visi Misi berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function kelolaLokasi(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-lokasi', [
            'lokasi' => $sitePages['lokasi'] ?? [
                'title' => 'Lokasi Kegiatan',
                'content' => '',
            ],
        ]);
    }

    public function kelolaPenyewaan(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-penyewaan', [
            'penyewaan' => $sitePages['penyewaan'] ?? [
                'title' => 'Penyewaan Fasilitas',
                'content' => '',
                'link' => '',
                'whatsapp_name' => '',
                'whatsapp_link' => '',
            ],
        ]);
    }

    public function kelolaBooklet(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-booklet', [
            'booklet' => $sitePages['booklet-band'] ?? [
                'title' => 'Booklet Profil Band',
                'content' => '',
                'cards' => [],
            ],
        ]);
    }

    public function kelolaUndangan(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-undangan', [
            'undangan' => $sitePages['undangan-media-partner'] ?? [
                'title' => 'Undangan dan Media Partner',
                'content' => '',
                'images' => [],
            ],
        ]);
    }

    public function kelolaRilisan(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-rilisan', [
            'rilisan' => $sitePages['rilisan'] ?? [
                'title' => 'Rilisan Terbaru',
                'content' => '',
                'items' => [],
            ],
        ]);
    }

    public function kelolaInformasi(): View
    {
        $sitePages = $this->sitePageStore->all();

        return view('admin.kelola-informasi', [
            'informasi' => $sitePages['informasi'] ?? [
                'title' => 'Pusat Informasi',
                'content' => '',
            ],
        ]);
    }

    public function updateBooklet(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'content' => ['nullable', 'string', 'max:5000'],
            'cards' => ['nullable', 'array'],
            'cards.*.name' => ['required', 'string', 'max:120'],
            'cards.*.photo_url' => ['nullable', 'url', 'max:500'],
            'cards.*.description' => ['nullable', 'string', 'max:5000'],
            'cards.*.role' => ['nullable', 'string', 'max:5000'],
            'cards.*.whatsapp_name' => ['nullable', 'string', 'max:120'],
            'cards.*.whatsapp_link' => ['nullable', 'url', 'max:500'],
        ]);

        $cards = array_values(array_filter($validated['cards'] ?? [], function (array $card): bool {
            return trim($card['name'] ?? '') !== '';
        }));

        $this->sitePageStore->update('booklet-band', [
            'title' => $validated['title'],
            'content' => $validated['content'] ?? '',
            'cards' => $cards,
        ]);

        return redirect()
            ->route('admin.kelola-booklet')
            ->with('status', 'Halaman Booklet berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updateUndangan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'content' => ['nullable', 'string', 'max:5000'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'url', 'max:500'],
            'whatsapp_name' => ['nullable', 'string', 'max:120'],
            'whatsapp_link' => ['nullable', 'url', 'max:500'],
        ]);

        $images = array_values(array_filter(array_map(static function ($image): ?string {
            $image = is_string($image) ? trim($image) : '';

            return $image !== '' ? $image : null;
        }, $validated['images'] ?? [])));

        $this->sitePageStore->update('undangan-media-partner', [
            'title' => $validated['title'],
            'content' => $validated['content'] ?? '',
            'images' => $images,
            'whatsapp_name' => $validated['whatsapp_name'] ?? '',
            'whatsapp_link' => $validated['whatsapp_link'] ?? '',
        ]);

        return redirect()
            ->route('admin.kelola-undangan')
            ->with('status', 'Halaman Undangan berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updateRilisan(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'items' => ['nullable', 'array'],
            'items.*.title' => ['required', 'string', 'max:200'],
            'items.*.type' => ['nullable', 'string', 'max:60'],
            'items.*.artist' => ['nullable', 'string', 'max:120'],
            'items.*.link' => ['nullable', 'url', 'max:500'],
            'items.*.image_url' => ['nullable', 'url', 'max:500'],
            'items.*.audio_url' => ['nullable', 'url', 'max:500'],
            'items.*.description' => ['nullable', 'string', 'max:1000'],
        ]);

        $existing = $this->sitePageStore->all();
        $currentRilisan = $existing['rilisan'] ?? ['content' => ''];

        $items = array_values(array_filter(array_map(static function ($item) {
            if (!is_array($item)) {
                return null;
            }

            $title = trim($item['title'] ?? '');
            if ($title === '') {
                return null;
            }

            return [
                'title' => $title,
                'type' => trim($item['type'] ?? ''),
                'artist' => trim($item['artist'] ?? ''),
                'link' => trim($item['link'] ?? ''),
                'image_url' => trim($item['image_url'] ?? ''),
                'audio_url' => trim($item['audio_url'] ?? ''),
                'description' => trim($item['description'] ?? ''),
            ];
        }, $validated['items'] ?? [])));

        $this->sitePageStore->update('rilisan', [
            'title' => $validated['title'],
            'content' => $currentRilisan['content'] ?? '',
            'items' => $items,
        ]);

        return redirect()
            ->route('admin.kelola-rilisan')
            ->with('status', 'Halaman Rilisan berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updateInformasi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'cards' => ['nullable', 'array'],
            'cards.*.title' => ['nullable', 'string', 'max:200'],
            'cards.*.image_url' => ['nullable', 'url', 'max:500'],
            'cards.*.description' => ['nullable', 'string', 'max:5000'],
        ]);

        $cards = array_values(array_filter(array_map(static function ($card): ?array {
            if (!is_array($card)) {
                return null;
            }

            $title = trim((string) ($card['title'] ?? ''));
            $imageUrl = trim((string) ($card['image_url'] ?? ''));
            $description = trim((string) ($card['description'] ?? ''));

            if ($title === '' && $imageUrl === '' && $description === '') {
                return null;
            }

            return [
                'title' => $title,
                'image_url' => $imageUrl,
                'description' => $description,
            ];
        }, $validated['cards'] ?? [])));

        $this->sitePageStore->update('informasi', [
            'title' => $validated['title'],
            'content' => '',
            'cards' => $cards,
        ]);

        return redirect()
            ->route('admin.kelola-informasi')
            ->with('status', 'Halaman Informasi berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updatePenyewaan(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'link' => ['nullable', 'url', 'max:500'],
            'whatsapp_name' => ['nullable', 'string', 'max:120'],
            'whatsapp_link' => ['nullable', 'url', 'max:500'],
        ]);

        $this->sitePageStore->update('penyewaan', [
            'title' => $validated['title'],
            'link' => $validated['link'] ?? '',
            'whatsapp_name' => $validated['whatsapp_name'] ?? '',
            'whatsapp_link' => $validated['whatsapp_link'] ?? '',
        ]);

        return redirect()
            ->route('admin.kelola-penyewaan')
            ->with('status', 'Halaman Penyewaan berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updateLokasi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'content' => ['nullable', 'string', 'max:5000'],
            'map_url' => ['nullable', 'url', 'max:500'],
        ]);

        $this->sitePageStore->update('lokasi', [
            'title' => $validated['title'],
            'content' => $validated['content'] ?? '',
            'map_url' => $validated['map_url'] ?? '',
        ]);

        return redirect()
            ->route('admin.kelola-lokasi')
            ->with('status', 'Halaman Lokasi berhasil diperbarui dan tersinkron ke halaman user.');
    }

    public function updatePengurus(Request $request, string $role): RedirectResponse
    {
        if (!in_array($role, ['ketum', 'waketum', 'sekben', 'litbang', 'manajemen-event', 'manajemen-talent', 'produksi', 'rumah-tangga', 'psdm'], true)) {
            abort(404);
        }

        if ($role === 'ketum') {
            $formType = $request->input('form_type');

            if ($formType === 'page') {
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:120'],
                ]);

                $this->pengurusProfileStore->update('ketum', $validated);
            } elseif ($formType === 'card') {
                $validated = $request->validate([
                    'name' => ['required', 'string', 'max:120'],
                    'position' => ['required', 'string', 'max:120'],
                    'photo_url' => ['nullable', 'url', 'max:500'],
                ]);

                if (($validated['photo_url'] ?? null) === '') {
                    $validated['photo_url'] = null;
                }

                $this->pengurusProfileStore->update('ketum', $validated);
            } else {
                abort(422);
            }
        } else {
            $formType = $request->input('form_type');

            if ($formType === 'page') {
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:120'],
                ]);

                $this->pengurusProfileStore->update($role, $validated);
            } elseif ($formType === 'cards') {
                if (in_array($role, ['manajemen-event', 'manajemen-talent', 'produksi', 'rumah-tangga', 'psdm'], true)) {
                    $validated = $request->validate([
                        'leader_name' => ['required', 'string', 'max:120'],
                        'leader_photo_url' => ['nullable', 'url', 'max:500'],
                        'vice_name' => ['required', 'string', 'max:120'],
                        'vice_photo_url' => ['nullable', 'url', 'max:500'],
                        'staff_cards' => ['nullable', 'array'],
                        'staff_cards.*.name' => ['required', 'string', 'max:120'],
                        'staff_cards.*.photo_url' => ['nullable', 'url', 'max:500'],
                    ]);

                    $cards = [
                        [
                            'name' => $validated['leader_name'],
                            'position' => 'Kepala Divisi',
                            'photo_url' => ($validated['leader_photo_url'] ?? null) === '' ? null : ($validated['leader_photo_url'] ?? null),
                        ],
                        [
                            'name' => $validated['vice_name'],
                            'position' => 'Wakil Kepala Divisi',
                            'photo_url' => ($validated['vice_photo_url'] ?? null) === '' ? null : ($validated['vice_photo_url'] ?? null),
                        ],
                    ];

                    foreach (($validated['staff_cards'] ?? []) as $staff) {
                        $cards[] = [
                            'name' => $staff['name'],
                            'position' => 'Staff',
                            'photo_url' => ($staff['photo_url'] ?? null) === '' ? null : ($staff['photo_url'] ?? null),
                        ];
                    }

                    $this->pengurusProfileStore->update($role, [
                        'cards' => $cards,
                    ]);

                    return redirect()
                        ->route('admin.kelola-pengurus')
                        ->with('status', 'Data ' . strtoupper($role) . ' berhasil diperbarui dan tersinkron ke halaman user.');
                }

                $validated = $request->validate([
                    'cards' => ['required', 'array', 'min:1'],
                    'cards.*.name' => ['required', 'string', 'max:120'],
                    'cards.*.position' => ['required', 'string', 'max:120'],
                    'cards.*.photo_url' => ['nullable', 'url', 'max:500'],
                ]);

                $cards = array_map(function (array $card): array {
                    if (($card['photo_url'] ?? null) === '') {
                        $card['photo_url'] = null;
                    }

                    return $card;
                }, $validated['cards']);

                $this->pengurusProfileStore->update($role, [
                    'cards' => array_values($cards),
                ]);
            } else {
                abort(422);
            }
        }

        return redirect()
            ->route('admin.kelola-pengurus')
            ->with('status', 'Data ' . strtoupper($role) . ' berhasil diperbarui dan tersinkron ke halaman user.');
    }
}