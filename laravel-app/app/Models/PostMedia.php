<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'file_path',
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(UserPost::class);
    }

    public function getFilePathAttribute(): string
    {
        return 'storage/' . $this->attributes['file_path'];
    }
}
