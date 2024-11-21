<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'status', 'user_id'];

    public static function booted(): void
    {
        static::creating(function ($query) {
            $query->slug = str_replace(' ', '-', $query->title . Str::random(2));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
