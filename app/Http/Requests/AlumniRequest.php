<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class AlumniRequest extends VideoRequest
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
            'company' => 'required|string',
            'content' => 'required|string',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
