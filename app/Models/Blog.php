<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'status', 'published_at', 'user_id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $perPage = 5;

    public static function booted(): void
    {
        static::creating(function ($query) {
            static::regenerateSlug($query);
        });

        static::updating(function ($query) {
            static::regenerateSlug($query);
        });
    }

    private static function regenerateSlug($query): string
    {
        $slug = str_replace(' ', '-', $query->title);
        $slug = strtolower($slug);
        $original = $slug;
        while (self::query()->where('slug', $slug)->exists()) {
            $slug = $original.'-'.Str::slug(rand(111111, 9999999));
        }
        return $query->slug = $slug;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
