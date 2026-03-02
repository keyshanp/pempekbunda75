<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
        
        // Cari user berdasarkan email
        $user = User::where('email', $this->email)->first();
        
        // Cek apakah user ada
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak terdaftar.',
            ]);
        }
        
        // Cek apakah user adalah admin
        if (!$user->is_admin) {
            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses admin.',
            ]);
        }
        
        // Cek password
        if (!Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Password salah.',
            ]);
        }
        
        // Login user
        auth()->login($user, $this->remember);
        
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