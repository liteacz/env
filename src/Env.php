<?php

declare(strict_types=1);

namespace Litea\Utils;

class Env
{
    public const DELIMITER = ';';

    /**
     * @param mixed $default
     * @return bool|array<mixed>|float|int|string|null
     */
    public static function get(string $name, $default = null)
    {
        $value = \getenv($name);

        if ($value === false) {
            return $default;
        }

        return self::convert($value);
    }

    /**
     * @param mixed $default
     * @return array<mixed>
     */
    public static function getArray(string $name, $default = null, string $delimiter = self::DELIMITER): array
    {
        $value = self::get($name, $default);

        if (\is_string($value) && $delimiter) {
            return \explode($delimiter, $value);
        }

        return [];
    }

    /**
     * @return bool|int|float|null|string
     */
    protected static function convert(string $value)
    {
        if (\preg_match('/^[0]+[0-9]+$/', $value)) {
            return $value;
        }

        if (\preg_match('/^[0-9]+$/', $value)) {
            return (int)$value;
        }

        if (\preg_match('/^[0-9]+\.[0-9]+$/', $value)) {
            return (float)$value;
        }

        switch (\strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'null':
                return null;
        }

        return $value;
    }
}