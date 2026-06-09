<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_com_sucesso(): void
    {
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_senha_sem_maiuscula_e_rejeitada(): void
    {
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }

    public function test_senha_sem_numero_e_rejeitada(): void
    {
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Senhaaaaa',
            'password_confirmation' => 'Senhaaaaa',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }

    public function test_senha_menor_que_8_e_rejeitada(): void
    {
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Se1',
            'password_confirmation' => 'Se1',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }

    public function test_senhas_nao_coincidem(): void
    {
        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Diferente456',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }

    public function test_nome_menor_que_3_e_rejeitado(): void
    {
        $response = $this->post('/register', [
            'name' => 'AB',
            'email' => 'joao@example.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('name');
    }

    public function test_email_duplicado_e_rejeitado(): void
    {
        User::factory()->create(['email' => 'joao@example.com']);

        $response = $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_novo_user_nao_e_admin_por_padrao(): void
    {
        $this->post('/register', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => 'Senha123',
            'password_confirmation' => 'Senha123',
        ]);

        $user = User::where('email', 'joao@example.com')->first();
        $this->assertFalse($user->isAdmin());
        $this->assertEquals(0, $user->is_admin);
    }
}
