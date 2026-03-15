<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class AdminLogin extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.admin-login';
    
    // Matikan navigasi sidebar
    protected static bool $shouldRegisterNavigation = false;
    
    // DEKLARASIKAN PROPERTIES UNTUK LIVEWIRE
    public $email = '';
    public $password = '';
    public $remember = false;
    
    // 🔥 REDIRECT KE DASHBOARD JIKA SUDAH LOGIN
    public function mount(): void
    {
        // Cek apakah user sudah login dan adalah admin
        if (Filament::auth()->check() && Filament::auth()->user()->is_admin) {
            // Redirect langsung ke dashboard admin
            $this->redirect('/admin', navigate: false);
            return;
        }
    }
    
    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }
    
    public function authenticate(): ?LoginResponse
    {
        // Validasi input manual karena kita pakai Livewire properties langsung
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login via web guard (Filament default)
        if (! auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = auth()->user();

        if (! $user->is_admin) {
            auth()->logout();

            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses admin.',
            ]);
        }

        // Regenerate session untuk keamanan
        session()->regenerate();

        // Redirect ke dashboard admin
        return app(LoginResponse::class);
    }
    
    // Method ini diperlukan untuk form schema di Filament
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->autocomplete()
                    ->extraInputAttributes(['wire:model' => 'email']),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->extraInputAttributes(['wire:model' => 'password']),
                Checkbox::make('remember')
                    ->label('Ingat saya')
                    ->extraInputAttributes(['wire:model' => 'remember']),
            ]);
    }
}