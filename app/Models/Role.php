<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // making role model know that it belongs to a M:M relationship so that laravel eloquent knows how to retrieve data
    public function users()
    {
        return $this->belongsToMany(related: 'App\Models\User');
    }
}
