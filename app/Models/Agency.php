<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'owner_id',
    ];

    // Owner relationship
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Users in this agency
public function users()
{
    return $this->belongsToMany(User::class)
        ->withPivot('role')
        ->withTimestamps();
}


    // Expenses of this agency
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // Invoices of this agency
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
