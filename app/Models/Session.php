<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
