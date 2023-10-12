<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public $timestamps = true;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute(): string
    {
        $information = $this->information;

        if ($information) {
            $first_name = $information->first_name;
            $middle_name = $information->middle_name;
            $last_name = $information->last_name;

            return "{$first_name} {$middle_name} {$last_name}";
        }

        return '';
    }

    public function getLikesAttribute(): int
    {
        return $this->posts->pluck('likes')->flatten()->count();
    }

    /**
     * Get the image path of the latest uploaded profile.
     */
    public function getImagePathAttribute(): string
    {
        return $this->media->last()->file_path;
    }

    public function isFollowing(User $user): bool
    {
        return $this->following->contains($user);
    }

    public function information(): HasOne
    {
        return $this->hasOne(UserInformation::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(UserPost::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_followers', 'following_id', 'follower_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'following_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(UserMedia::class, 'user_id');
    }

    public function postMedia(): HasOne
    {
        return $this->hasOne(PostMedia::class, 'user_id');
    }
}
