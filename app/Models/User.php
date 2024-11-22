<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasTwoFactorAuthentication;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    const ROL_ADMINISTRADOR =  1;
    const ROL_OPERATIVO = 2;
    const ROL_CONDUCTOR = 3;
    const ROL_CLIENTE = 4;

    const ROL_DEFAULT = self::ROL_CLIENTE;

    const ROLES = [
        self::ROL_ADMINISTRADOR => 'Administrador',
        self::ROL_OPERATIVO => 'Operativo',
        self::ROL_CONDUCTOR => 'Conductor',
        self::ROL_CLIENTE => 'Cliente',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() || $this->isOperativo() || $this->isConductor();
    }

    public function isAdmin()
    {
        return $this->role === self::ROL_ADMINISTRADOR;

    }

    public function isOperativo()
    {
        return $this->role === self::ROL_OPERATIVO;
        
    }

    public function isConductor()
    {
        return $this->role === self::ROL_CONDUCTOR;
    }

    public function isCliente()
    {
        return $this->role === self::ROL_CLIENTE;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surnames',
        'phone',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
