<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

// Agency the user belongs to
public function agency()
{
    return $this->belongsTo(Agency::class);
}

// Expenses created by this user
public function expenses()
{
    return $this->hasMany(Expense::class);
}

// Invoices created by this user (if Owner/Accountant)
public function invoices()
{
    return $this->hasMany(Invoice::class, 'created_by');
}

public function agencies()
{
    return $this->belongsToMany(Agency::class, 'agency_user');
}



}
