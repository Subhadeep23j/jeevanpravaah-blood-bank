<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image_path',
        'phone',
        'aadhar',
        'address',
        'city',
        'pin',
        'password',
        'donations_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'donations_count' => 'integer',
        ];
    }

    public function donations()
    {
        return $this->hasMany(Donor::class);
    }

    /**
     * Accessor: Computed URL for the user's profile image based on DB path
     */
    public function getProfileImageUrlAttribute(): string
    {
        $path = $this->profile_image_path;
        if ($path && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }
        return asset('assets/profile.svg');
    }
}
