<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
    ];
    public $timestamps = true;

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
