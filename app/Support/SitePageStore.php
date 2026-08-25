<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SitePageStore
{
    private const FILE_NAME = 'site_pages.json';
    private const STORAGE_KEY = 'site_pages';
    private const STORAGE_TABLE = 'app_storage';

    public function all(): array
    {
        $default = $this->defaultPages();
        $stored = $this->getStoredPages();

        if ($stored === null) {
            return $default;
        }

        $decoded = json_decode($stored, true);

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

        $this->savePages($pages);
    }

    private function getStoredPages(): ?string
    {
        if ($this->hasDatabaseTable()) {
            $row = DB::table(self::STORAGE_TABLE)->where('key', self::STORAGE_KEY)->first();

            if ($row !== null) {
                return $row->data;
            }

            $this->savePages($this->defaultPages());
            return null;
        }

        $path = $this->getStoragePath();

        if (!File::exists($path)) {
            File::ensureDirectoryExists(dirname($path));
            File::put($path, json_encode($this->defaultPages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return null;
        }

        return (string) File::get($path);
    }

    private function savePages(array $pages): void
    {
        if ($this->hasDatabaseTable()) {
            DB::table(self::STORAGE_TABLE)->updateOrInsert(
                ['key' => self::STORAGE_KEY],
                ['data' => json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'updated_at' => now(), 'created_at' => now()]
            );
            return;
        }

        $path = $this->getStoragePath();
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function hasDatabaseTable(): bool
    {
        try {
            return DB::getSchemaBuilder()->hasTable(self::STORAGE_TABLE);
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function getStoragePath(): string
    {
        $storagePath = storage_path('app/' . self::FILE_NAME);

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
            'informasi' => [
                'title' => 'Pusat Informasi',
                'content' => '',
                'cards' => [],
            ],
        ];
    }
}
