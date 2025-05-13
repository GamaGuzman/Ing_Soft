<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field',
        'speciality',
        'age',
        'rfc',
        'office_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
