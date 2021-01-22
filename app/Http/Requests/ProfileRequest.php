<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class ProfileRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
        ];
    }
}
