<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class FooterRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required|string',
            'value' => 'required|string'
        ];
    }
}
