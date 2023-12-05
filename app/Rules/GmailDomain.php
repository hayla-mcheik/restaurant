<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GmailDomain implements Rule
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
        return str_ends_with($value, '@gmail.com');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must end with @gmail.com';
    }
}
