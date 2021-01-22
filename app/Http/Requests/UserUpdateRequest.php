<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('id'))
            ],
            'password' => 'nullable|string|confirmed',
            'role_id' => 'required|numeric'
        ];
    }
}
