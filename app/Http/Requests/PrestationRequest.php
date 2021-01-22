<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class PrestationRequest extends VideoRequest
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
            'rank' => 'required|string',
            'year' => 'required|numeric',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
