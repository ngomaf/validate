<?php

namespace Ngomafortuna\Validate;

/**
 * <b>Validate</b>
 * This class is a helper, to filter_var/datas comming oh form with base in FILTER_SANITIZE
 * 
 * copyright (c) 2025, ngoma m. fortuna of the mostarda tec
 */
class Validate
{
    public static function get(array $fields, array $data): array {
        $validate = [];

        foreach ($fields as $field => $type) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $rawValue = $data[$field];
            $value = is_string($rawValue) ? trim($rawValue) : $rawValue;

            $validate[$field] = match ($type) {
                's' => filter_var((string) $value, FILTER_SANITIZE_SPECIAL_CHARS),
                'i' => self::validateInteger($value),
                'e' => self::validateEmail($value),
                'u' => self::validateUrl($value),
                'b' => self::validateBoolean($value),
                '*' => $rawValue,
                default => $rawValue
            };
        }

        // remove sanitized item of the array $data
        foreach (array_keys($data) as $index) {
            if (array_key_exists($index, $validate)) {
                unset($data[$index]);
            }
        }

        return array_merge($validate, $data);
    }

    private static function validateInteger(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value;
        }

        if (!is_string($value) && !is_float($value)) {
            return null;
        }

        $int = filter_var($value, FILTER_VALIDATE_INT);
        return ($int === false) ? null : $int;
    }

    private static function validateEmail(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $email = filter_var(trim($value), FILTER_VALIDATE_EMAIL);
        return ($email === false) ? null : $email;
    }

    private static function validateUrl(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $url = filter_var(trim($value), FILTER_VALIDATE_URL);
        if ($url === false) {
            return null;
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));
        if (!in_array($scheme, ['http', 'https'], true)) {
            return null;
        }

        return $url;
    }

    private static function validateBoolean(mixed $value): ?int
    {
        $bool = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($bool === null) {
            return null;
        }

        return $bool ? 1 : 0;
    }

}