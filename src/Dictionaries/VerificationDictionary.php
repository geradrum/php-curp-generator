<?php

namespace Geradrum\Curp\Dictionaries;

class VerificationDictionary
{
    /**
     * Verification digits.
     *
     * @var array|int[]
     */
    protected static array $digits = [
        '0' => 0,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        'A' => 10,
        'B' => 11,
        'C' => 12,
        'D' => 13,
        'E' => 14,
        'F' => 15,
        'G' => 16,
        'H' => 17,
        'I' => 18,
        'J' => 19,
        'K' => 20,
        'L' => 21,
        'M' => 22,
        'N' => 23,
        'Ñ' => 24,
        'O' => 25,
        'P' => 26,
        'Q' => 27,
        'R' => 28,
        'S' => 29,
        'T' => 30,
        'U' => 31,
        'V' => 32,
        'W' => 33,
        'X' => 34,
        'Y' => 35,
        'Z' => 36,
    ];

    /**
     * Get verification digits.
     *
     * @return array
     */
    public static function verificationDigits(): array
    {
        return self::$digits;
    }

    /**
     * Get individual verification digit.
     *
     * @param $key
     * @return int
     */
    public function getVerificationDigit($key): int
    {
        if (in_array($key, array_keys(self::$digits))) {
            return self::$digits[$key];
        }

        return -1;
    }
}