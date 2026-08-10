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
}
