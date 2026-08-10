<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class PengurusProfileStore
{
    private const FILE_NAME = 'pengurus_profiles.json';

    public function all(): array
    {
        $default = $this->defaultProfiles();
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

        File::put($this->path(), json_encode($profiles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function path(): string
    {
        return storage_path('app/' . self::FILE_NAME);
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
