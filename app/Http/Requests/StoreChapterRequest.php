<?php

namespace App\Http\Requests;

use App\DataTransferObjects\CreateChapterData;
use Illuminate\Foundation\Http\FormRequest;

final class StoreChapterRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'content' => ['required', 'string', 'max:200000'],
            'index' => ['required', 'integer'],
        ];
    }

    public function resolveData(): CreateChapterData
    {
        return new CreateChapterData(...$this->safe()->all());
    }
}
