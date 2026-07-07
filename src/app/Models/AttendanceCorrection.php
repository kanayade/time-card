<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCorrection extends Model
{
    use HasFactory;
    
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function breakTimes()
    {
        return $this->hasMany(BreakTimeCorrection::class);
    }
    public function breakTimeCorrections()
    {
        return $this->hasMany(BreakTimeCorrection::class);
    }
    protected $fillable = [
        'attendance_id',
        'user_id',
        'corrected_start_time',
        'corrected_end_time',
        'status',
        'reason',
    ];
}
