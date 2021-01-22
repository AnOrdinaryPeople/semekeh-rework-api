<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class CarouselRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|numeric|min:1|max:2',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
