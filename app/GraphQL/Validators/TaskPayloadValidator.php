<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class TaskPayloadValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'due_date' => 'Due date is required and must be in the formate YYYY-MM-DD, YYYY/MM/DD',
        ];
    }
}
