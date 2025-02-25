<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    const ABOUT = 'about';

    protected $fillable = [
        'user_id',
        'data',
        'type'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
