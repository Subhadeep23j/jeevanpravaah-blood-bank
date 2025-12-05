<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'blood_group',
        'weight',
        'height',
        'medical_conditions',
        'address',
        'city',
        'state',
        'pincode',
        'availability',
        'travel_distance',
        'consent_medical',
        'consent_contact',
        'consent_privacy',
        'user_id',
        'approval_status',
        'approved_at',
        'approved_by',
        'rejection_reason',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'availability' => 'array',
        'consent_medical' => 'boolean',
        'consent_contact' => 'boolean',
        'consent_privacy' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
