<?php

declare(strict_types=1);

use Litea\Utils\Env;
use PHPUnit\Framework\TestCase;

final class EnvTest extends TestCase
{
    /**
     * @covers \Litea\Utils\Env::get
     * @covers \Litea\Utils\Env::convert
     */
    public function testCorrectEnvGet(): void
    {
        \putenv('BOOLEAN=true');
        self::assertTrue(Env::get('BOOLEAN'));
        \putenv('BOOLEAN=false');
        self::assertFalse(Env::get('BOOLEAN'));
        \putenv('NOTHING=');
        self::assertEquals('', Env::get('NOTHING'));
        \putenv('NOTHING=null');
        self::assertNull(Env::get('NOTHING'));
        \putenv('NOTHING=null');
        self::assertNull(Env::get('NOTHING'));
        \putenv('INT=2425');
        self::assertEquals(2425, Env::get('INT'));
        \putenv('FLOAT=2425.24');
        self::assertEquals(2425.24, Env::get('FLOAT'));
        \putenv('STRING=02425');
        self::assertEquals('02425', Env::get('STRING'));

        self::assertEquals(null, Env::get('ENVIRONMENT'));
        self::assertEquals('default', Env::get('ENVIRONMENT', 'default'));
        self::assertEquals('true', Env::get('ENVIRONMENT', 'true'));
        self::assertEquals('false', Env::get('ENVIRONMENT', 'false'));
        self::assertEquals('null', Env::get('ENVIRONMENT', 'null'));

        self::assertTrue(Env::get('ENVIRONMENT', true));
        self::assertFalse(Env::get('ENVIRONMENT', false));
        self::assertNull(Env::get('ENVIRONMENT', null));

        self::assertIsInt(Env::get('ENVIRONMENT', 123456));
        self::assertIsInt(Env::get('ENVIRONMENT', 0));
        self::assertEquals(0, Env::get('ENVIRONMENT', 0));

        self::assertEquals('02531348', Env::get('ENVIRONMENT', '02531348'));
    }

    /**
     * @covers \Litea\Utils\Env::getArray
     * @covers \Litea\Utils\Env::get
     * @covers \Litea\Utils\Env::convert
     */
    public function testCorrectEnvGetArray(): void
    {
        self::assertIsArray(Env::getArray('EMAILS'));
        self::assertIsArray(Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));
        self::assertCount(3, Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));

        self::assertIsArray(Env::getArray('EMAILS', null));
        self::assertCount(0, Env::getArray('EMAILS', null, Env::DELIMITER));

        self::assertIsArray(Env::getArray('EMAILS', true));
        self::assertCount(0, Env::getArray('EMAILS', true, Env::DELIMITER));
        self::assertIsArray(Env::getArray('ENVIRONMENT', 123456));
    }
}
