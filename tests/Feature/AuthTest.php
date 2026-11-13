<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('PunkTicket Admin');
    }

    public function test_admin_can_authenticate_and_access_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Atta Alfarizi',
            'email' => 'admin@punkticket.id',
            'password' => Hash::make('punkrock2026'),
            'role' => 'admin',
            'status' => 'Aktif',
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@punkticket.id',
            'password' => 'punkrock2026',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect('/dashboard');
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'Aktif',
        ]);

        $response = $this->post('/login', [
            'email' => 'budi@gmail.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
