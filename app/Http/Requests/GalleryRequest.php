<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class GalleryRequest extends VideoRequest
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
        ];
    }
}
