<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowedHtmlTags implements Rule
{
    public function passes($attribute, $value)
    {
        // Define the allowed HTML tags
        $allowedTags = ['a', 'code', 'i', 'strong'];

        // Use the strip_tags function to remove all HTML tags
        $strippedValue = strip_tags($value, '<' . implode('><', $allowedTags) . '>');

        // Compare the stripped value with the original value
        return $strippedValue === $value;
    }

    public function message()
    {
        return 'The :attribute field contains disallowed HTML tags.';
    }
}
