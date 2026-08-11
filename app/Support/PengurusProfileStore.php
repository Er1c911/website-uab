<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PengurusProfileStore
{
    private const FILE_NAME = 'pengurus_profiles.json';
    private const STORAGE_KEY = 'pengurus_profiles';
    private const STORAGE_TABLE = 'app_storage';

    public function all(): array
    {
        $default = $this->defaultProfiles();
        $stored = $this->getStoredProfiles();

        if ($stored === null) {
            return $default;
        }

        $decoded = json_decode($stored, true);

        if (!is_array($decoded)) {
            return $default;
        }

        $profiles = array_replace_recursive($default, $decoded);

        if (isset($profiles['manajemen-event']['cards']) && is_array($profiles['manajemen-event']['cards'])) {
            $cards = array_values($profiles['manajemen-event']['cards']);
            $cards[0] = array_merge([
                'name' => 'Nama Kepala Divisi',
                'position' => 'Kepala Divisi',
                'photo_url' => null,
            ], $cards[0] ?? []);
            $cards[0]['position'] = 'Kepala Divisi';

            $cards[1] = array_merge([
                'name' => 'Nama Wakil Kepala Divisi',
                'position' => 'Wakil Kepala Divisi',
                'photo_url' => null,
            ], $cards[1] ?? []);
            $cards[1]['position'] = 'Wakil Kepala Divisi';

            $profiles['manajemen-event']['cards'] = $cards;
        }

        if (isset($profiles['manajemen-talent']['cards']) && is_array($profiles['manajemen-talent']['cards'])) {
            $cards = array_values($profiles['manajemen-talent']['cards']);
            $cards[0] = array_merge([
                'name' => 'Nama Kepala Divisi',
                'position' => 'Kepala Divisi',
                'photo_url' => null,
            ], $cards[0] ?? []);
            $cards[0]['position'] = 'Kepala Divisi';

            $cards[1] = array_merge([
                'name' => 'Nama Wakil Kepala Divisi',
                'position' => 'Wakil Kepala Divisi',
                'photo_url' => null,
            ], $cards[1] ?? []);
            $cards[1]['position'] = 'Wakil Kepala Divisi';

            $profiles['manajemen-talent']['cards'] = $cards;
        }

        if (isset($profiles['produksi']['cards']) && is_array($profiles['produksi']['cards'])) {
            $cards = array_values($profiles['produksi']['cards']);
            $cards[0] = array_merge([
                'name' => 'Nama Kepala Divisi',
                'position' => 'Kepala Divisi',
                'photo_url' => null,
            ], $cards[0] ?? []);
            $cards[0]['position'] = 'Kepala Divisi';

            $cards[1] = array_merge([
                'name' => 'Nama Wakil Kepala Divisi',
                'position' => 'Wakil Kepala Divisi',
                'photo_url' => null,
            ], $cards[1] ?? []);
            $cards[1]['position'] = 'Wakil Kepala Divisi';

            $profiles['produksi']['cards'] = $cards;
        }

        if (isset($profiles['rumah-tangga']['cards']) && is_array($profiles['rumah-tangga']['cards'])) {
            $cards = array_values($profiles['rumah-tangga']['cards']);
            $cards[0] = array_merge([
                'name' => 'Nama Kepala Divisi',
                'position' => 'Kepala Divisi',
                'photo_url' => null,
            ], $cards[0] ?? []);
            $cards[0]['position'] = 'Kepala Divisi';

            $cards[1] = array_merge([
                'name' => 'Nama Wakil Kepala Divisi',
                'position' => 'Wakil Kepala Divisi',
                'photo_url' => null,
            ], $cards[1] ?? []);
            $cards[1]['position'] = 'Wakil Kepala Divisi';

            $profiles['rumah-tangga']['cards'] = $cards;
        }

        if (isset($profiles['psdm']['cards']) && is_array($profiles['psdm']['cards'])) {
            $cards = array_values($profiles['psdm']['cards']);
            $cards[0] = array_merge([
                'name' => 'Nama Kepala Divisi',
                'position' => 'Kepala Divisi',
                'photo_url' => null,
            ], $cards[0] ?? []);
            $cards[0]['position'] = 'Kepala Divisi';

            $cards[1] = array_merge([
                'name' => 'Nama Wakil Kepala Divisi',
                'position' => 'Wakil Kepala Divisi',
                'photo_url' => null,
            ], $cards[1] ?? []);
            $cards[1]['position'] = 'Wakil Kepala Divisi';

            $profiles['psdm']['cards'] = $cards;
        }

        return $profiles;
    }

    public function update(string $role, array $data): void
    {
        $profiles = $this->all();

        if (!array_key_exists($role, $profiles)) {
            return;
        }

        foreach ($data as $key => $value) {
            $profiles[$role][$key] = $value;
        }

        $this->saveProfiles($profiles);
    }

    private function getStoredProfiles(): ?string
    {
        if ($this->hasDatabaseTable()) {
            $row = DB::table(self::STORAGE_TABLE)->where('key', self::STORAGE_KEY)->first();

            if ($row !== null) {
                return $row->data;
            }

            $this->saveProfiles($this->defaultProfiles());
            return null;
        }

        $path = $this->getStoragePath();

        if (!File::exists($path)) {
            File::ensureDirectoryExists(dirname($path));
            File::put($path, json_encode($this->defaultProfiles(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return null;
        }

        return (string) File::get($path);
    }

    private function saveProfiles(array $profiles): void
    {
        if ($this->hasDatabaseTable()) {
            DB::table(self::STORAGE_TABLE)->updateOrInsert(
                ['key' => self::STORAGE_KEY],
                ['data' => json_encode($profiles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'updated_at' => now(), 'created_at' => now()]
            );
            return;
        }

        $path = $this->getStoragePath();
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode($profiles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
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

    private function defaultProfiles(): array
    {
        return [
            'ketum' => [
                'title' => 'Ketua Umum UAB',
                'content' => 'Halaman ini berisi profil dan informasi Ketua Umum Unit Aktivitas Band.',
                'name' => 'Nama Ketua Umum',
                'position' => 'Ketua Umum',
                'photo' => null,
                'photo_url' => null,
            ],
            'waketum' => [
                'title' => 'Wakil Ketua Umum UAB',
                'content' => 'Halaman ini berisi profil dan informasi Wakil Ketua Umum Unit Aktivitas Band.',
                'cards' => [
                    [
                        'name' => 'Nama Waketum',
                        'position' => 'Wakil Ketua Umum',
                        'photo_url' => null,
                    ],
                ],
            ],
            'sekben' => [
                'title' => 'Sekretaris Bendahara UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Sekben',
                        'position' => 'Sekretaris Bendahara',
                        'photo_url' => null,
                    ],
                ],
            ],
            'litbang' => [
                'title' => 'Penelitian dan Pengembangan UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Litbang',
                        'position' => 'Litbang',
                        'photo_url' => null,
                    ],
                ],
            ],
            'manajemen-event' => [
                'title' => 'Manajemen Event UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Kepala Divisi',
                        'position' => 'Kepala Divisi',
                        'photo_url' => null,
                    ],
                    [
                        'name' => 'Nama Wakil Kepala Divisi',
                        'position' => 'Wakil Kepala Divisi',
                        'photo_url' => null,
                    ],
                ],
            ],
            'manajemen-talent' => [
                'title' => 'Manajemen Talent UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Kepala Divisi',
                        'position' => 'Kepala Divisi',
                        'photo_url' => null,
                    ],
                    [
                        'name' => 'Nama Wakil Kepala Divisi',
                        'position' => 'Wakil Kepala Divisi',
                        'photo_url' => null,
                    ],
                ],
            ],
            'produksi' => [
                'title' => 'Produksi UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Kepala Divisi',
                        'position' => 'Kepala Divisi',
                        'photo_url' => null,
                    ],
                    [
                        'name' => 'Nama Wakil Kepala Divisi',
                        'position' => 'Wakil Kepala Divisi',
                        'photo_url' => null,
                    ],
                ],
            ],
            'rumah-tangga' => [
                'title' => 'Rumah Tangga UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Kepala Divisi',
                        'position' => 'Kepala Divisi',
                        'photo_url' => null,
                    ],
                    [
                        'name' => 'Nama Wakil Kepala Divisi',
                        'position' => 'Wakil Kepala Divisi',
                        'photo_url' => null,
                    ],
                ],
            ],
            'psdm' => [
                'title' => 'PSDM UAB',
                'content' => '',
                'cards' => [
                    [
                        'name' => 'Nama Kepala Divisi',
                        'position' => 'Kepala Divisi',
                        'photo_url' => null,
                    ],
                    [
                        'name' => 'Nama Wakil Kepala Divisi',
                        'position' => 'Wakil Kepala Divisi',
                        'photo_url' => null,
                    ],
                ],
            ],
        ];
    }
}
