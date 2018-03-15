<?php
declare(strict_types=1);

use Litea\Utils\Env;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

Assert::same(null, Env::get('ENVIRONMENT'));
Assert::same('default', Env::get('ENVIRONMENT', 'default'));
Assert::true(Env::get('ENVIRONMENT', 'true'));
Assert::false(Env::get('ENVIRONMENT', 'false'));
Assert::null(Env::get('ENVIRONMENT', 'null'));

Assert::true(Env::get('ENVIRONMENT', true));
Assert::false(Env::get('ENVIRONMENT', false));
Assert::null(Env::get('ENVIRONMENT', null));

Assert::type('int', Env::get('ENVIRONMENT', 123456));
