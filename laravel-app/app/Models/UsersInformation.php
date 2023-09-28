<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'bio',
        'gender',
    ];

    public $timestamps = true;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
