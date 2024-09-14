<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $title
 * @property-read Book $book
 * @property string $content
 * @property int $index
 */
final class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'book_id',
        'content',
        'index',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
