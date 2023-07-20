<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function getCreatedAtAttribute($value) {
        
        $timeZone = Config::get('app.timezone');
        return Carbon::parse($value)->timezone($timeZone)->format('H:i');
    }
}
