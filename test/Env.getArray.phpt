<?php
declare(strict_types=1);

use Litea\Utils\Env;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

Assert::type('array', Env::getArray('EMAILS'));
Assert::type('array', Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));
Assert::count(3, Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));

Assert::type('array', Env::getArray('EMAILS', null));
Assert::count(0, Env::getArray('EMAILS', null, Env::DELIMITER));

Assert::type('array', Env::getArray('EMAILS', true));
Assert::count(0, Env::getArray('EMAILS', true, Env::DELIMITER));

$e = Assert::exception(function () {
	Env::getArray('EMAILS', true, true);
}, TypeError::class, 'Argument 3 passed to Litea\Utils\Env::getArray() must be of the type string, boolean given, called in %a% on line %d%');