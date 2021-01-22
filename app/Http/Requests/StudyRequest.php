<?php

namespace App\Http\Requests;

use App\Http\Requests\VideoRequest;
use Illuminate\Validation\Rule;

class StudyRequest extends VideoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banner' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000',
            'title' => [
                'required',
                'string',
                Rule::unique('studies', 'title')->ignore($this->route('id'))
            ],
            'content' => 'required|string',
            'title_2' => 'required|string',
            'content_2' => 'required|string',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ];
    }
}
