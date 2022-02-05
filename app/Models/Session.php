<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isAvailable()
    {
        return $this->appointments()->count() < $this->activity->max_participants;
    }
}
