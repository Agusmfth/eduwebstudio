<?php

namespace Tests\Feature;

use App\Models\ContentItem;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_admin_can_login_and_manage_content(): void
    {
        $user = User::factory()->create(['password' => bcrypt('secret123')]);
        $this->post('/login', ['email' => $user->email, 'password' => 'secret123'])->assertRedirect('/admin');
        $this->actingAs($user)->get('/admin')->assertOk()->assertSee('Dashboard');
        $this->actingAs($user)->post('/admin/konten/services', [
            'title' => 'Layanan Baru', 'description' => 'Deskripsi layanan', 'sort_order' => 1, 'is_active' => 1,
        ])->assertRedirect();
        $this->assertDatabaseHas('content_items', ['section' => 'services', 'title' => 'Layanan Baru']);
    }

    public function test_admin_can_open_and_update_settings(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/admin/pengaturan')->assertOk();
        $this->actingAs($user)->put('/admin/pengaturan', [
            'brand' => 'EduWeb Studio', 'hero_badge' => 'Spesialis Website Pendidikan',
            'hero_title' => 'Website sekolah profesional', 'hero_text' => 'Deskripsi hero yang cukup.',
            'whatsapp' => '62895321272932', 'whatsapp_secondary' => '628131951083',
            'email' => 'hello@example.test', 'address' => 'Jakarta',
            'cta_title' => 'Mari mulai', 'cta_text' => 'Konsultasi gratis untuk sekolah.',
        ])->assertRedirect();
    }

    public function test_visitor_can_submit_consultation(): void
    {
        $this->post('/konsultasi', [
            'name' => 'Andi', 'school' => 'SMAN 1', 'phone' => '08123456789',
            'email' => 'andi@example.test', 'message' => 'Kami membutuhkan website sekolah.',
        ])->assertSessionHas('success');
        $this->assertDatabaseCount('inquiries', 1);
    }
}
