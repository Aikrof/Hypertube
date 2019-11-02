<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailDomainRule implements Rule
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
        $domain = substr(strrchr($value, "@"), 1);
        $mx = getmxrr($domain, $mx_records, $mx_weight);

        if ($mx == false || count($mx_records) == 0 ||
            (count($mx_records) == 1 && ($mx_records[0] == null || $mx_records[0] == "0.0.0.0")))
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid email address.';
    }
}
