<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Rules\Recaptcha;

class AuthRequest extends FormRequest
{
    public $val = false;

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
    public function rules(Recaptcha $recap)
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha' => ['required', $recap]
        ];
    }

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
