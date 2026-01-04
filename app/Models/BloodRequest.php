<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'patient_name',
        'phone',
        'address',
        'hospital_name',
        'blood_type',
        'doctor_prescription',
        'units_required',
        'urgency',
        'status',
    ];

    /**
     * Get the user that made the blood request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
