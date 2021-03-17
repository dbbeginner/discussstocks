<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validTimeZoneBySymbol implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $timezones = ["NST","MIT","HST","AST","PST","PNT","MST","CST","EST",
            "IET","PRT","CNT","AGT","BET","CAT","UTC","ECT","EET","ART","EAT",
            "MET","NET","PLT","IST","BST","VST","CTT","JST","ACT","AET","SST"];

        foreach ($timezones as $timezone) {
            if ($value == $timezone) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not a valid timezone entry.';
    }
}
