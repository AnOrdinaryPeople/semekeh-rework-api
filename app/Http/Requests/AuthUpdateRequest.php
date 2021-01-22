<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class AuthUpdateRequest extends VideoRequest
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
            'pass' => 'required|string',
            'password' => 'nullable|confirmed'
        ];
    }
}
