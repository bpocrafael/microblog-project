<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'email_verification_code',
        'email_verified_at',
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

    /**
     * Get the full name of the user.
     */
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

    /**
     * Get the total likes of the user.
     */
    public function getLikesAttribute(): int
    {
        return $this->posts->pluck('likes')->flatten()->count();
    }

    /**
     * Get the image path of the latest uploaded profile.
     */
    public function getImagePathAttribute(): string
    {
        return $this->media->last()->file_path ?? 'assets/images/user-solid.svg';
    }

    /**
     * Get all the posts of following users and own posts.
     */
    public function getFollowingPostsAttribute(): LengthAwarePaginator
    {
        $followingWithAuthId = $this->following->pluck('id')->push($this->id);

        return UserPost::whereIn('user_id', $followingWithAuthId)
            ->with('user')
            ->latest('created_at')
            ->paginate(4);
    }

    /**
     * Check if this user is following the user.
     */
    public function isFollowing(?User $user): bool
    {
        if ($user != null) {
            return $this->following->contains($user);
        }

        return false;
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
