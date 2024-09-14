<?php

namespace App\Http\Requests;

use App\DataTransferObjects\UpdateChapterData;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateChapterRequest extends FormRequest
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

    public function resolveData(): UpdateChapterData
    {
        return new UpdateChapterData(...$this->safe()->all());
    }
}
