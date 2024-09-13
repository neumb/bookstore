<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string|null $information
 * @property \DateTimeInterface|null $birthday
 */
final class Author extends Model
{
    use HasFactory;

    protected $casts = [
        'birthday' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'information',
        'birthday',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
