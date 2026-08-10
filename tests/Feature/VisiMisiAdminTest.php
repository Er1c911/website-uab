<?php

namespace Tests\Feature;

use App\Support\SitePageStore;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class VisiMisiAdminTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        File::delete(storage_path('app/site_pages.json'));
    }

    public function test_admin_page_shows_separate_vision_and_mission_forms(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->get('/admin/kelola-visi-misi');

        $response->assertOk();
        $response->assertSee('Visi');
        $response->assertSee('Misi');
    }

    public function test_admin_can_save_vision_and_mission_separately(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->post('/admin/kelola-visi-misi', [
                'title' => 'Visi dan Misi UAB',
                'vision' => 'Visi kami adalah...',
                'mission' => 'Misi kami adalah...',
            ]);

        $response->assertRedirect('/admin/kelola-visi-misi');

        $page = app(SitePageStore::class)->all()['visi-misi'] ?? [];

        $this->assertSame('Visi kami adalah...', $page['vision'] ?? null);
        $this->assertSame('Misi kami adalah...', $page['mission'] ?? null);
    }
}
