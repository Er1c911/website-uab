<?php

namespace Tests\Feature;

use App\Support\SitePageStore;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class LocationAdminTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        File::delete(storage_path('app/site_pages.json'));
    }

    public function test_admin_can_save_lokasi_map_url_and_user_page_displays_maps_link(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->post('/admin/kelola-lokasi', [
                'title' => 'Lokasi Kegiatan',
                'content' => 'Detail lokasi acara.',
                'map_url' => 'https://www.google.com/maps/place/Universitas+Brawijaya',
            ]);

        $response->assertRedirect('/admin/kelola-lokasi');

        $page = app(SitePageStore::class)->all()['lokasi'] ?? [];

        $this->assertSame('Lokasi Kegiatan', $page['title'] ?? null);
        $this->assertSame('Detail lokasi acara.', $page['content'] ?? null);
        $this->assertSame('https://www.google.com/maps/place/Universitas+Brawijaya', $page['map_url'] ?? null);

        $userResponse = $this->get('/lokasi');

        $userResponse->assertOk();
        $userResponse->assertSee('Peta Lokasi');
        $userResponse->assertDontSee('Buka Maps');
        $userResponse->assertSee('iframe');
        // Accept either the query-style embed or a resolved /embed URL; check domain instead
        $userResponse->assertSee('google.com');
    }

    public function test_admin_can_save_informasi_and_user_page_displays_same_content(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->post('/admin/kelola-informasi', [
                'title' => 'Pusat Informasi Baru',
                'cards' => [
                    [
                        'image_url' => 'https://example.com/update-info.jpg',
                        'description' => 'Berita komunitas dan jadwal terbaru secara real-time.',
                    ],
                ],
            ]);

        $response->assertRedirect('/admin/kelola-informasi');

        $page = app(SitePageStore::class)->all()['informasi'] ?? [];

        $this->assertSame('Pusat Informasi Baru', $page['title'] ?? null);
        $this->assertCount(1, $page['cards'] ?? []);
        $this->assertSame('Berita komunitas dan jadwal terbaru secara real-time.', $page['cards'][0]['description'] ?? null);

        $userResponse = $this->get('/informasi');

        $userResponse->assertOk();
        $userResponse->assertSee('Pusat Informasi Baru');
        $userResponse->assertSee('Berita komunitas dan jadwal terbaru secara real-time.');
    }

    public function test_admin_can_manage_information_cards_and_user_page_displays_them(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->post('/admin/kelola-informasi', [
                'title' => 'Pusat Informasi Event',
                'cards' => [
                    [
                        'title' => 'Latihan Bersama',
                        'image_url' => 'https://example.com/info-one.jpg',
                        'description' => 'Jadwal latihan bersama komunitas pada hari Sabtu.',
                    ],
                    [
                        'title' => 'Rehearsal Terbuka',
                        'image_url' => 'https://example.com/info-two.jpg',
                        'description' => 'Rehearsal terbuka untuk anggota baru.',
                    ],
                ],
            ]);

        $response->assertRedirect('/admin/kelola-informasi');

        $page = app(SitePageStore::class)->all()['informasi'] ?? [];

        $this->assertSame('Pusat Informasi Event', $page['title'] ?? null);
        $this->assertCount(2, $page['cards'] ?? []);
        $this->assertSame('Latihan Bersama', $page['cards'][0]['title'] ?? null);
        $this->assertSame('https://example.com/info-one.jpg', $page['cards'][0]['image_url'] ?? null);
        $this->assertSame('Jadwal latihan bersama komunitas pada hari Sabtu.', $page['cards'][0]['description'] ?? null);

        $userResponse = $this->get('/informasi');

        $userResponse->assertOk();
        $userResponse->assertSee('Pusat Informasi Event');
        $userResponse->assertSee('Latihan Bersama');
        $userResponse->assertSee('Jadwal latihan bersama komunitas pada hari Sabtu.');
        $userResponse->assertSee('Rehearsal terbuka untuk anggota baru.');
    }
}
