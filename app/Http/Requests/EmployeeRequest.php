<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;

class EmployeeRequest extends VideoRequest
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
            'name' => 'required|string',
            'type' => 'required|numeric|min:1|max:3',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
