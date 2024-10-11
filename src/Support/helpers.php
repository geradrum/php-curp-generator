<?php

use Geradrum\Curp\Dictionaries\BlacklistDictionary;

if (! function_exists('camel_case')) {
    /**
     * Convert string to camel case.
     *
     * @param string $string
     * @return string
     */
    function camel_case(string $string): string
    {
        $camel = explode('_', $string);
        $camel = implode('', array_map(function($word) {
            return ucwords($word);
        }, $camel));

        return $camel;
    }
}

if (! function_exists('normalize')) {
    /**
     * Normalize string.
     *
     * @param string $string
     * @return string
     */
    function normalize(string $string): string
    {
        $string = replace_special_chars($string);
        $string = preg_replace('/[Ñ]/', 'X', $string);
        $string = preg_replace('/[^a-zA-Z\s]+/', ' ', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        return trim($string);
    }
}

if (! function_exists('replace_special_chars')) {
    /**
     * Replace special characters.
     *
     * @param string $string
     * @return string
     */
    function replace_special_chars(string $string): string
    {
        $characters = mb_str_split($string);

        foreach ($characters as $index => $char) {
            if (in_array($char, array_keys(BlacklistDictionary::replacementChars()))) {
                $characters[$index] = BlacklistDictionary::getReplacementChar($char);
            }
        }

        return implode('', $characters);
    }
}