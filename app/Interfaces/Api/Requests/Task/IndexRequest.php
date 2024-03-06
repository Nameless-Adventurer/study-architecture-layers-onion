<?php

namespace Api\Requests\Task;


use App\Enums\TaskEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:3072',
            'status' => ['required', 'string', Rule::in(TaskEnum::getStatuses())]
        ];
    }
}
