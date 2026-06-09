<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/' => 'A senha deve conter pelo menos uma letra maiúscula.',
                'regex:/[0-9]/' => 'A senha deve conter pelo menos um número.',
            ],
        ], [
            'name.required' => 'Informe seu nome completo.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'email.required' => 'Informe seu melhor email.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado. Faça login ou use outro email.',
            'password.required' => 'Crie uma senha para sua conta.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem. Verifique o campo de confirmação.',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula e um número.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Conta criada com sucesso! Bem-vindo(a)!');
    }
}
