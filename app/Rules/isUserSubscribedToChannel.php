<?php

namespace App\Rules;

use App\Models\Subscriptions;
use Illuminate\Contracts\Validation\Rule;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

class isUserSubscribedToChannel implements Rule
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
        $id = Hashids::decode($value);

        $subscriptions = Subscriptions::where('content_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        if(!$subscriptions->isEmpty()) {
            return true;
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
        return 'You must be subscribed to a channel before you can post to it.';
    }
}
