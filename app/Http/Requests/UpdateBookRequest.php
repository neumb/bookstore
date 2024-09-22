<?php

namespace App\Http\Requests;

use App\DataTransferObjects\UpdateBookData;
use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateBookRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'author_id' => ['required', 'integer', Rule::exists(Author::class, 'id')],
            'annotation' => ['nullable', 'string', 'max:1000'],
            'published_at' => ['required', 'date_format:d-m-Y'],
        ];
    }

    public function resolveData(): UpdateBookData
    {
        return new UpdateBookData(...$this->safe()->all());
    }
}
