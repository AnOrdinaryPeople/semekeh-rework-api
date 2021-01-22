<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class SocialRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'required|string',
            'link' => [
                'required',
                'string',
                'regex:#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i'
            ],
        ];
    }
}
