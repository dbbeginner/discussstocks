<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Channel;

class isChannelTitleUnique implements Rule
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
        return Channel::where('type', '=', 'channel')
            ->where('title', '=', $value)
            ->get()
            ->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A channel already has this title.';
    }
}
