<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class AgendaRequest extends VideoRequest
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
            'time' => 'required|string',
            'content' => 'required|string',
            'banner' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
