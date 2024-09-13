<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $title
 * @property-read Author $author
 * @property string|null $annotation
 * @property \DateTimeInterface $published_at
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
}
