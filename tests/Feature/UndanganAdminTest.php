<?php

namespace Tests\Feature;

use App\Support\SitePageStore;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class UndanganAdminTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        File::delete(storage_path('app/site_pages.json'));
    }

    public function test_admin_can_save_undangan_content_and_user_page_displays_it(): void
    {
        $response = $this->withSession(['is_admin_authenticated' => true])
            ->post('/admin/kelola-undangan', [
                'title' => 'Undangan dan Media Partner',
                'content' => 'Khusus untuk kerja sama media dan undangan penampilan.',
                'images' => [
                    'https://example.com/1.png',
                    'https://example.com/2.png',
                ],
            ]);

        $response->assertRedirect('/admin/kelola-undangan');

        $page = app(SitePageStore::class)->all()['undangan-media-partner'] ?? [];

        $this->assertSame('Undangan dan Media Partner', $page['title'] ?? null);
        $this->assertSame('Khusus untuk kerja sama media dan undangan penampilan.', $page['content'] ?? null);
        $this->assertSame([
            'https://example.com/1.png',
            'https://example.com/2.png',
        ], $page['images'] ?? []);

        $userResponse = $this->get('/undangan-media-partner');

        $userResponse->assertOk();
        $userResponse->assertSee('Khusus untuk kerja sama media dan undangan penampilan.');
        $userResponse->assertSee('https://example.com/1.png');
    }
}
