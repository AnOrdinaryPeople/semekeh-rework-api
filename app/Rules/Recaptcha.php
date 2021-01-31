<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ImplicitRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $req = Http::post('https://google.com/recaptcha/api/siteverify?'.http_build_query([
            'secret' => config('recaptcha_secret'),
            'response' => $value,
            'remoteip' => request()->ip()
        ]));

        return json_decode($req->body())->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.recaptcha.failed');
    }
}
