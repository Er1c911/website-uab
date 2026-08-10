<?php

namespace App\Http\Controllers;

use App\Support\PengurusProfileStore;
use App\Support\SitePageStore;
use Illuminate\View\View;

class UserPageController extends Controller
{
    public function __construct(
        private PengurusProfileStore $pengurusProfileStore,
        private SitePageStore $sitePageStore
    )
    {
    }

    public function index(): View
    {
        return $this->renderPage('beranda');
    }

    public function ketum(): View
    {
        return $this->renderPage('ketum');
    }

    public function waketum(): View
    {
        return $this->renderPage('waketum');
    }

    public function sekben(): View
    {
        return $this->renderPage('sekben');
    }

    public function litbang(): View
    {
        return $this->renderPage('litbang');
    }

    public function manajemenEvent(): View
    {
        return $this->renderPage('manajemen-event');
    }

    public function manajemenTalent(): View
    {
        return $this->renderPage('manajemen-talent');
    }

    public function produksi(): View
    {
        return $this->renderPage('produksi');
    }

    public function rumahTangga(): View
    {
        return $this->renderPage('rumah-tangga');
    }

    public function psdm(): View
    {
        return $this->renderPage('psdm');
    }

    public function visiMisi(): View
    {
        return $this->renderPage('visi-misi');
    }

    public function lokasi(): View
    {
        return $this->renderPage('lokasi');
    }

    public function penyewaan(): View
    {
        return $this->renderPage('penyewaan');
    }

    public function bookletBand(): View
    {
        return $this->renderPage('booklet-band');
    }

    public function undanganMediaPartner(): View
    {
        return $this->renderPage('undangan-media-partner');
    }

    public function rilisan(): View
    {
        return $this->renderPage('rilisan');
    }

    public function informasi(): View
    {
        return $this->renderPage('informasi');
    }

    private function renderPage(string $slug): View
    {
        $profiles = $this->pengurusProfileStore->all();
        $sitePages = $this->sitePageStore->all();
        $ketumPhotoUrl = $profiles['ketum']['photo_url'] ?? null;

        if (empty($ketumPhotoUrl) && !empty($profiles['ketum']['photo'])) {
            $ketumPhotoUrl = asset($profiles['ketum']['photo']);
        }

        $pages = [
            'beranda' => [
                'label' => 'Beranda',
                'route' => 'user.beranda',
                'title' => 'Selamat Datang di Homeband',
                'content' => 'Homeband adalah ruang kreatif untuk berkumpul, berlatih, dan berkolaborasi bagi para musisi.',
                'showInMenu' => true,
            ],
            'ketum' => [
                'label' => 'Pengurus',
                'route' => 'user.ketum',
                'title' => $profiles['ketum']['title'],
                'content' => $profiles['ketum']['content'],
                'name' => $profiles['ketum']['name'] ?? 'Nama Ketua Umum',
                'position' => $profiles['ketum']['position'] ?? 'Ketua Umum',
                'photo_url' => $ketumPhotoUrl,
                'showInMenu' => true,
            ],
            'waketum' => [
                'label' => 'Waketum',
                'route' => 'user.waketum',
                'title' => $profiles['waketum']['title'],
                'content' => $profiles['waketum']['content'],
                'cards' => $profiles['waketum']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'sekben' => [
                'label' => 'Sekben',
                'route' => 'user.sekben',
                'title' => $profiles['sekben']['title'] ?? 'Sekretaris Bendahara UAB',
                'content' => $profiles['sekben']['content'] ?? '',
                'cards' => $profiles['sekben']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'litbang' => [
                'label' => 'Litbang',
                'route' => 'user.litbang',
                'title' => $profiles['litbang']['title'] ?? 'Penelitian dan Pengembangan UAB',
                'content' => $profiles['litbang']['content'] ?? '',
                'cards' => $profiles['litbang']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'manajemen-event' => [
                'label' => 'Manajemen Event',
                'route' => 'user.manajemen-event',
                'title' => $profiles['manajemen-event']['title'] ?? 'Manajemen Event UAB',
                'content' => $profiles['manajemen-event']['content'] ?? '',
                'cards' => $profiles['manajemen-event']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'manajemen-talent' => [
                'label' => 'Manajemen Talent',
                'route' => 'user.manajemen-talent',
                'title' => $profiles['manajemen-talent']['title'] ?? 'Manajemen Talent UAB',
                'content' => $profiles['manajemen-talent']['content'] ?? '',
                'cards' => $profiles['manajemen-talent']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'produksi' => [
                'label' => 'Produksi',
                'route' => 'user.produksi',
                'title' => $profiles['produksi']['title'] ?? 'Produksi UAB',
                'content' => $profiles['produksi']['content'] ?? '',
                'cards' => $profiles['produksi']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'rumah-tangga' => [
                'label' => 'Rumah Tangga',
                'route' => 'user.rumah-tangga',
                'title' => $profiles['rumah-tangga']['title'] ?? 'Rumah Tangga UAB',
                'content' => $profiles['rumah-tangga']['content'] ?? '',
                'cards' => $profiles['rumah-tangga']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'psdm' => [
                'label' => 'PSDM',
                'route' => 'user.psdm',
                'title' => $profiles['psdm']['title'] ?? 'PSDM UAB',
                'content' => $profiles['psdm']['content'] ?? '',
                'cards' => $profiles['psdm']['cards'] ?? [],
                'showInMenu' => false,
            ],
            'visi-misi' => [
                'label' => 'Visi Misi',
                'route' => 'user.visi-misi',
                'title' => $sitePages['visi-misi']['title'] ?? 'Visi dan Misi Homeband',
                'vision' => $sitePages['visi-misi']['vision'] ?? 'Membangun ekosistem musik yang inklusif, kreatif, dan suportif bagi seluruh anggota.',
                'mission' => $sitePages['visi-misi']['mission'] ?? 'Mendukung talenta lokal melalui edukasi, kolaborasi, dan publikasi karya.',
                'showInMenu' => true,
            ],
            'lokasi' => [
                'label' => 'Lokasi',
                'route' => 'user.lokasi',
                'title' => $sitePages['lokasi']['title'] ?? 'Lokasi Kegiatan',
                'content' => $sitePages['lokasi']['content'] ?? 'Informasi lokasi studio, venue acara, dan titik kumpul komunitas Homeband tersedia di halaman ini.',
                'map_url' => $sitePages['lokasi']['map_url'] ?? '',
                'map_embed_url' => $this->convertMapUrlToEmbed($sitePages['lokasi']['map_url'] ?? ''),
                'showInMenu' => true,
            ],
            'penyewaan' => [
                'label' => 'Penyewaan',
                'route' => 'user.penyewaan',
                'title' => $sitePages['penyewaan']['title'] ?? 'Penyewaan Fasilitas',
                'content' => $sitePages['penyewaan']['content'] ?? '',
                'link' => $sitePages['penyewaan']['link'] ?? '',
                'whatsapp_name' => $sitePages['penyewaan']['whatsapp_name'] ?? '',
                'whatsapp_link' => $sitePages['penyewaan']['whatsapp_link'] ?? '',
                'showInMenu' => true,
            ],
            'booklet-band' => [
                'label' => 'Booklet Band',
                'route' => 'user.booklet-band',
                'title' => $sitePages['booklet-band']['title'] ?? 'Booklet Profil Band',
                'content' => $sitePages['booklet-band']['content'] ?? '',
                'cards' => $sitePages['booklet-band']['cards'] ?? [],
                'showInMenu' => true,
            ],
            'undangan-media-partner' => [
                'label' => 'Undangan & Media Partner',
                'route' => 'user.undangan-media-partner',
                'title' => $sitePages['undangan-media-partner']['title'] ?? 'Undangan dan Media Partner',
                'content' => $sitePages['undangan-media-partner']['content'] ?? '',
                'images' => $sitePages['undangan-media-partner']['images'] ?? [],
                'whatsapp_name' => $sitePages['undangan-media-partner']['whatsapp_name'] ?? '',
                'whatsapp_link' => $sitePages['undangan-media-partner']['whatsapp_link'] ?? '',
                'showInMenu' => true,
            ],
            'rilisan' => [
                'label' => 'Rilisan',
                'route' => 'user.rilisan',
                'title' => $sitePages['rilisan']['title'] ?? 'Rilisan Terbaru',
                'content' => $sitePages['rilisan']['content'] ?? '',
                'items' => $sitePages['rilisan']['items'] ?? [],
                'showInMenu' => true,
            ],
            'informasi' => [
                'label' => 'Informasi',
                'route' => 'user.informasi',
                'title' => 'Pusat Informasi',
                'content' => 'Berisi pengumuman jadwal, berita komunitas, dan informasi penting lainnya untuk anggota maupun publik.',
                'showInMenu' => true,
            ],
        ];

        $currentPage = $pages[$slug] ?? $pages['beranda'];

        return view('user.index', [
            'pages' => $pages,
            'currentSlug' => $slug,
            'currentPage' => $currentPage,
        ]);
    }

    private function convertMapUrlToEmbed(string $mapUrl): string
    {
        if ($mapUrl === '') {
            return '';
        }

        $url = $mapUrl;
        if (!preg_match('/^https?:\/\//', $url)) {
            $url = 'https://' . $url;
        }

        if (str_contains($url, '/maps/embed')) {
            return $url;
        }

        $parsed = parse_url($url);
        if ($parsed === false || empty($parsed['host'])) {
            return '';
        }

        $host = $parsed['host'];
        if (!str_contains($host, 'google.com') && !str_contains($host, 'goo.gl')) {
            return '';
        }

        parse_str($parsed['query'] ?? '', $queryParams);
        $query = $queryParams['q'] ?? '';

        if ($query === '' && !empty($parsed['path'])) {
            if (preg_match('#/maps/place/([^/]+)#', $parsed['path'], $match)) {
                $query = urldecode($match[1]);
            } elseif (preg_match('#/maps/search/([^/]+)#', $parsed['path'], $match)) {
                $query = urldecode($match[1]);
            } elseif (preg_match('#/maps/@([0-9\.\-]+,[0-9\.\-]+)#', $parsed['path'], $match)) {
                $query = $match[1];
            } elseif (preg_match('#/maps/dir/([^/]+)#', $parsed['path'], $match)) {
                $query = urldecode($match[1]);
            }
        }

        if ($query === '' && !empty($parsed['path'])) {
            $path = trim($parsed['path'], '/');
            if ($path !== '') {
                $query = $path;
            }
        }

        if ($query === '') {
            if (str_contains($host, 'goo.gl') || str_contains($host, 'maps.app.goo.gl')) {
                $embedUrl = 'https://www.google.com/maps?output=embed&q=' . urlencode($mapUrl);
                return $this->resolveGoogleMapsEmbedRedirect($embedUrl);
            }

            return '';
        }

        $embedUrl = 'https://www.google.com/maps?q=' . urlencode($query) . '&output=embed';
        return $this->resolveGoogleMapsEmbedRedirect($embedUrl);
    }

    private function resolveGoogleMapsEmbedRedirect(string $embedUrl): string
    {
        if (!function_exists('get_headers')) {
            return $embedUrl;
        }

        $headers = @get_headers($embedUrl, 1);
        if ($headers === false) {
            return $embedUrl;
        }

        $location = $headers['Location'] ?? $headers['location'] ?? null;
        if (is_array($location)) {
            $location = end($location);
        }

        if (is_string($location) && str_contains($location, '/maps/embed')) {
            return $location;
        }

        return $embedUrl;
    }
}