<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'roleType' => ['required', Rule::in([1, 2])],
                'name' => ['required', 'min:4'],
                'email' => ['required', 'email'],
                'password' => ['required'],
            ];
        } else {
            return [
                'roleType' => ['sometimes', 'required', Rule::in([1, 2])],
                'name' => ['sometimes', 'required', 'min:4'],
                'email' => ['sometimes', 'required', 'email'],
                'password' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->roleType) {
            $this->merge([
                'role_type' => $this->roleType
            ]);
        }
    }

    protected function passedValidation()
    {
        if ($this->password) {
            $this->merge([
                'password' => bcrypt($this->password),
            ]);
        }
    }
}
