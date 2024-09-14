<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 * @property-read Author $author
 * @property string|null $annotation
 * @property \DateTimeInterface $published_at
 * @property-read Collection<Chapter> $chapters
 */
final class Book extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'author_id',
        'annotation',
        'published_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
