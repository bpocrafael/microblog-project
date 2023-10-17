<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'image',
    ];
    public $timestamps = true;

    /**
     * Check if the original poster is still followed by the user.
     */
    public function isContentAvailableFor(User $user): bool
    {
        if (!$this->isShared() || ($this->originalPost != null && $this->originalPost->user != null && $user != null && $this->originalPost->user->id === $user->id)) {

            return !$this->isOriginalDeleted();
        }

        if ($user != null && $this->originalPost !== null && $this->originalPost->user !== null) {
            return $user->isFollowing($this->originalPost->user);
        }

        return false;
    }

    /**
     * Check if the original post is deleted.
     */
    public function isOriginalDeleted(): bool
    {
        return $this->isShared() && $this->originalPost === null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class, 'post_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    public function media(): HasOne
    {
        return $this->hasOne(PostMedia::class, 'post_id', 'id');
    }

    public function shares(): HasMany
    {
        return $this->hasMany(UserPost::class, 'original_post_id');
    }

    public function originalPost(): BelongsTo
    {
        return $this->belongsTo(UserPost::class, 'original_post_id');
    }

    public function isShared(): bool
    {
        return $this->original_post_id !== null;
    }

}
