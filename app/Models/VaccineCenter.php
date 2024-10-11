<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'daily_limit',
    ];

    public function scheduledVaccinations()
    {
        return $this->hasMany(ScheduledVaccination::class);
    }
}
