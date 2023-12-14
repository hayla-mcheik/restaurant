<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailDomain implements Rule
{
    protected $allowedDomains;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($allowedDomains)
    {
        $this->allowedDomains = $allowedDomains;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the email domain is in the allowed domains array
        $emailParts = explode('@', $value);
        $domain = end($emailParts);
    
        // Debugging
        \Log::info('Extracted Domain:', ['domain' => $domain]);
    
        return in_array($domain, $this->allowedDomains);
    }
    

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must have a valid email domain.';
    }
}
