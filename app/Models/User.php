<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Поля, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Поля, которые должны быть скрыты при сериализации.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Поля, которые нужно привести к определённому типу.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Проверяет, является ли пользователь администратором.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}