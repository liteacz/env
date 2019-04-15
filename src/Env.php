<?php

declare(strict_types = 1);

namespace Litea\Utils;

/**
 * Class Env
 *
 * @package Litea\Utils
 */
class Env
{

    const DELIMITER = ';';

    /**
     * @param string $name
     * @param null   $default
     *
     * @return bool|int|null|string
     */
    public static function get(string $name, $default = null)
    {

        $value = getenv($name);
        if ($value === false) {
            return self::convert($default);
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

        if (is_string($value)) {
            return explode($delimiter, $value);
        }

        return [];
    }

    /**
     * @param $value
     *
     * @return bool|int|null|string
     */
    protected static function convert($value)
    {

        if ($value === null) {
            return $value;
        } else {
            if (is_bool($value)) {
                return $value;
            } else {
                if (preg_match('/^[0]+[0-9]+$/', (string)$value)) {
                    return (string)$value;
                } else {
                    if (preg_match('/^[0-9]+$/', (string)$value)) {
                        return (int)$value;
                    }
                }
            }
        }

        if (is_array($value)) {
            return null;
        }

        switch (strtolower($value)) {
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