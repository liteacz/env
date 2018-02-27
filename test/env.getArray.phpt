<?php
declare(strict_types=1);

use Litea\Utils\Env;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

Assert::type('array', Env::getArray('EMAILS'));
Assert::type('array', Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));
Assert::count(3, Env::getArray('EMAILS','zero;first;second', Env::DELIMITER));
