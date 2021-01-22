<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class CompanyRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
            'link' => [
                'required',
                'string',
                'regex:#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i'
            ],
        ];
    }
}
