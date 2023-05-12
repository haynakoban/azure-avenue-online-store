<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.roleType' => ['required', Rule::in([1, 2])],
            '*.name' => ['required', 'min:4'],
            '*.email' => ['required', 'email'],
            '*.password' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['role_type'] = $obj['roleType'] ?? null;

            $data[] = $obj; 
        }

        $this->merge($data);
    }

    protected function passedValidation()
    {
        $data = $this->all();

        foreach ($data as &$obj) {
            $obj['password'] = bcrypt($obj['password']);
        }

        $this->replace($data);
    }
}
