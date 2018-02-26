<?php
declare(strict_types=1);

namespace Litea\Utils;

/**
 * Class Env
 *
 * @package Litea\Utils
 */
class Env {

	/**
	 * @param string $name
	 * @param null   $default
	 *
	 * @return bool|int|null|string
	 */
	public static function get(string $name, $default = null) {
		$value = getenv($name);
		if ($value === false) {
			return $default;
		}

		return self::convert($value);
	}

	/**
	 * @param string $name
	 * @param string $delimiter
	 * @param null   $default
	 *
	 * @return array
	 */
	public static function getArray(string $name, string $delimiter = ';', $default = null) {
		$value = self::get($name . $default);

		return explode($delimiter, $value);
	}

	/**
	 * @param $value
	 *
	 * @return bool|int|null|string
	 */
	protected static function convert($value) {
		$origValue = $value;
		$value     = strtolower($value);

		switch ($value) {
			case 'true':
				return true;

			case 'false':
				return false;

			case 'null':
				return null;
		}

		if (ctype_digit($value)) {
			return (int)$value;
		}

		return $origValue;
	}

}