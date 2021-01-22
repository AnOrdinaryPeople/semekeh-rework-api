<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
            'video' => 'required|string'
        ];
    }

    public $val = false;
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $val){
        $this->val = $val;
    }
}
