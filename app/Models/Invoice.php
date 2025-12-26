<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    public function agency()
{
    return $this->belongsTo(Agency::class);
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function expenses()
{
    return $this->hasMany(Expense::class);
}

}
