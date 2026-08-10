<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class SitePageStore
{
    private const FILE_NAME = 'site_pages.json';

    public function all(): array
    {
        $default = $this->defaultPages();
        $path = $this->path();

        if (!File::exists($path)) {
            File::ensureDirectoryExists(dirname($path));
            File::put($path, json_encode($default, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $default;
        }

        $decoded = json_decode((string) File::get($path), true);

        if (!is_array($decoded)) {
            return $default;
        }

        return array_replace_recursive($default, $decoded);
    }

    public function update(string $slug, array $data): void
    {
        $pages = $this->all();

        if (!array_key_exists($slug, $pages)) {
            return;
        }

        foreach ($data as $key => $value) {
            $pages[$slug][$key] = $value;
        }

        File::put($this->path(), json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function path(): string
    {
        $storagePath = storage_path('app/' . self::FILE_NAME);

        // Use storage_path if writable; otherwise fall back to system temp directory
        $storageDir = dirname($storagePath);
        if (is_dir($storageDir) && is_writable($storageDir)) {
            return $storagePath;
        }

        return rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }

    private function defaultPages(): array
    {
        return [
            'visi-misi' => [
                'title' => 'Visi dan Misi Homeband',
                'vision' => 'Membangun ekosistem musik yang inklusif, kreatif, dan suportif bagi seluruh anggota.',
                'mission' => 'Mendukung talenta lokal melalui edukasi, kolaborasi, dan publikasi karya.',
            ],
            'lokasi' => [
                'title' => 'Lokasi Kegiatan',
                'content' => '',
                'map_url' => '',
            ],
            'penyewaan' => [
                'title' => 'Penyewaan Fasilitas',
                'content' => '',
                'link' => '',
                'whatsapp_name' => '',
                'whatsapp_link' => '',
            ],
            'booklet-band' => [
                'title' => 'Booklet Profil Band',
                'content' => '',
                'cards' => [],
            ],
            'undangan-media-partner' => [
                'title' => 'Undangan dan Media Partner',
                'content' => '',
                'images' => [],
                'whatsapp_name' => '',
                'whatsapp_link' => '',
            ],
            'rilisan' => [
                'title' => 'Rilisan Terbaru',
                'content' => '',
                'items' => [],
            ],
        ];
    }
}
