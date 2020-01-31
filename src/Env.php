<?php

declare(strict_types=1);

namespace Litea\Utils;

class Env
{
    /** @var string */
    const DELIMITER = ';';

    /**
     * @param string $name
     * @param null   $default
     * @return bool|int|null|string
     */
    public static function get(string $name, $default = null)
    {

        $value = \getenv($name);
        if ($value === false) {
            return $default;
        } elseif (\is_array($value)) {
            return $value;
        }

        return self::convert($value);
    }

    /**
     * @param string $name
     * @param null   $default
     * @param string $delimiter
     *
     * @return array
     */
    public static function getArray(string $name, $default = null, string $delimiter = self::DELIMITER): array
    {

        $value = self::get($name, $default);

        if (\is_string($value)) {
            return \explode($delimiter, $value);
        }

        return [];
    }

    /**
     * @param $value
     * @return bool|int|null|string
     */
    protected static function convert(string $value)
    {
        if (\preg_match('/^[0]+[0-9]+$/', $value)) {
            return $value;
        } elseif (\preg_match('/^[0-9]+$/', $value)) {
            return (int)$value;
        } elseif (\preg_match('/^[0-9]+\.[0-9]+$/', $value)) {
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