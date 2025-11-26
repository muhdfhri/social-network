<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'nim',
        'username',
        'email',
        'email_verified_at',
        'description',
        'thumbnail',
        'profile',
        'gender',
        'relationship',
        'partner',
        'school',
        'college',
        'university',
        'work',
        'website',
        'location',
        'address',
        'is_private',
        'is_banned',
        'expiration_date',
        'banned_at',
        'banned_to',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'profile_photo_path',
        'current_team_id',
        'profile_photo_url',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        // Gunakan kolom 'profile' sebagai path foto profil
        return $this->profile 
                    ? asset('storage/' . $this->profile)
                    : $this->defaultProfilePhotoUrl();
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }

    public function is_friend()
    {
        return (Friend::where(['user_id' => $this->id])->orWhere('friend_id', $this->id)->first()->status ?? "");
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
