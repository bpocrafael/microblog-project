<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int @user_id
 * @property int @post_id
 */
class PostLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public $timestamps = false;

    public function posts(): BelongsTo
    {
        return $this->belongsTo(UserPost::class);
    }
}
