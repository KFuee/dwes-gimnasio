<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'duration',
        'max_participants',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function isAvailable()
    {
        if ($this->sessions->count() > 0) {
            foreach ($this->sessions as $session) {
                if ($session->isAvailable()) {
                    return true;
                    break;
                }
            }
        }

        return false;
    }
}
