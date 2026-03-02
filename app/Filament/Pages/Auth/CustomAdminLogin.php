<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomAdminLogin extends Page
{
    protected static string $view = 'filament.pages.auth.custom-admin-login';
    
    public ?array $data = [];
    
    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->intended('/admin');
        }
        
        $this->form->fill();
    }
    
    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->autocomplete(),
            \Filament\Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(),
            \Filament\Forms\Components\Checkbox::make('remember')
                ->label('Ingat saya'),
        ];
    }
    
    public function login()
    {
        $data = $this->form->getState();
        
        $user = \App\Models\User::where('email', $data['email'])->first();
        
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak terdaftar.',
            ]);
        }
        
        if (!$user->is_admin) {
            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses admin.',
            ]);
        }
        
        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Password salah.',
            ]);
        }
        
        auth()->login($user, $data['remember'] ?? false);
        
        return redirect()->intended('/admin');
    }
    
    public function getTitle(): string
    {
        return 'Login Admin';
    }
}