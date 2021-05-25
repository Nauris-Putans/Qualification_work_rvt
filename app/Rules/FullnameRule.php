<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FullnameRule implements Rule
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
        $regex = '/^([A-ZА-Я\p{Cyrillic}\p{Common}]|Ē|Ū|Ī|Ā|Š|Ģ|Ķ|Ļ|Ž|Č|Ņ)[а-яa-zA-ZА-Я\p{Cyrillic}\p{Common}ēūīāšģķļžčņĒŪĪĀŠĢĶĻŽČŅ -]+(?:\s([A-ZА-Я\p{Cyrillic}\p{Common}]|Ē|Ū|Ī|Ā|Š|Ģ|Ķ|Ļ|Ž|Č|Ņ)[a-zа-яA-ZА-Я\p{Cyrillic}\p{Common}ēūīāšģķļžčņĒŪĪĀŠĢĶĻŽČŅ -]+)+$/';

        if (preg_match($regex, $value))
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __(':attribute - :action', ['attribute' => __("Full name"), 'action' => __("is invalid!")]);
    }
}
