<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class UserRequest extends VideoRequest
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
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'role_id' => 'required|numeric'
        ];
    }
}
