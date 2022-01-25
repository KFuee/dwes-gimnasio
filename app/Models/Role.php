<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Devuelve una colección de usuarios que pertenecen a un rol
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
