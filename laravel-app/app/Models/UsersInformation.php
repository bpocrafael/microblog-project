<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public $timestamps = true;
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
