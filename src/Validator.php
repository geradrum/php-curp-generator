<?php

namespace Geradrum\Curp;

use DateTime;
use Geradrum\Curp\Dictionaries\EntityDictionary;
use InvalidArgumentException;

class Validator
{
    /**
     * Validate field/value.
     *
     * @param $field
     * @param $value
     * @return bool
     */
    public static function validate($field, $value): bool
    {
        $fieldName = camel_case($field);
        $method = "validate{$fieldName}";

        if (method_exists(self::class, $method)) {
            return call_user_func([self::class, $method], $value);
        }

        throw new InvalidArgumentException("Invalid field: '{$fieldName}'");
    }

    /**
     * Validate name.
     *
     * @param $value
     * @return bool
     */
    public static function validateName($value): bool
    {
        return ! empty($value) && is_string($value);
    }

    /**
     * Validate lastname.
     *
     * @param $value
     * @return bool
     */
    public static function validateLastname($value): bool
    {
        return ! empty($value) && is_string($value);
    }

    /**
     * Validate maternal lastname.
     *
     * @param $value
     * @return bool
     */
    public static function validateMaternalLastname($value): bool
    {
        return ! empty($value) && is_string($value);
    }

    /**
     * Validate birthdate.
     *
     * @param $value
     * @return bool
     */
    public static function validateBirthdate($value): bool
    {
        $format = 'Y-m-d';
        $dateTime = DateTime::createFromFormat($format, $value);
        return $dateTime && $dateTime->format($format) === $value;
    }

    /**
     * Validate entity.
     *
     * @param $value
     * @return bool
     */
    public static function validateEntity($value): bool
    {
        return ! empty($value) && ! is_null(EntityDictionary::getEntity($value));
    }

    /**
     * Validate gender.
     *
     * @param $value
     * @return bool
     */
    public static function validateGender($value): bool
    {
        return ! empty($value) && is_string($value) && in_array($value, ['H', 'M']);
    }

    /**
     * Validate options.
     *
     * @param $value
     * @return bool
     */
    public static function validateOptions($value): bool
    {
        return is_array($value);
    }
}
