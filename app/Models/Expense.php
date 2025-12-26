<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function agency()
{
    return $this->belongsTo(Agency::class);
}

public function invoice()
{
    return $this->belongsTo(Invoice::class)->nullable();
}

}
