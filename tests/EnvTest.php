<?php

declare(strict_types=1);

use Litea\Utils\Env;
use PHPUnit\Framework\TestCase;

final class EnvTest extends TestCase
{
    /**
     * @covers Litea\Utils\Env::get
     * @covers Litea\Utils\Env::convert
     */
    public function testCorrectEnvGet(): void
    {
        \putenv('BOOLEAN=true');
        $this->assertTrue(Env::get('BOOLEAN'));
        \putenv('BOOLEAN=false');
        $this->assertFalse(Env::get('BOOLEAN'));
        \putenv('NOTHING=');
        $this->assertEquals('', Env::get('NOTHING'));
        \putenv('NOTHING=null');
        $this->assertNull(Env::get('NOTHING'));
        \putenv('NOTHING=null');
        $this->assertNull(Env::get('NOTHING'));
        \putenv('INT=2425');
        $this->assertEquals(2425, Env::get('INT'));
        \putenv('FLOAT=2425.24');
        $this->assertEquals(2425.24, Env::get('FLOAT'));
        \putenv('STRING=02425');
        $this->assertEquals('02425', Env::get('STRING'));


        $this->assertEquals(null, Env::get('ENVIRONMENT'));
        $this->assertEquals('default', Env::get('ENVIRONMENT', 'default'));
        $this->assertEquals('true', Env::get('ENVIRONMENT', 'true'));
        $this->assertEquals('false', Env::get('ENVIRONMENT', 'false'));
        $this->assertEquals('null', Env::get('ENVIRONMENT', 'null'));

        $this->assertTrue(Env::get('ENVIRONMENT', true));
        $this->assertFalse(Env::get('ENVIRONMENT', false));
        $this->assertNull(Env::get('ENVIRONMENT', null));

        $this->assertIsInt(Env::get('ENVIRONMENT', 123456));
        $this->assertIsInt(Env::get('ENVIRONMENT', 0));
        $this->assertEquals(0, Env::get('ENVIRONMENT', 0));

        $this->assertEquals('02531348', Env::get('ENVIRONMENT', '02531348'));
        $this->assertIsString('02531348', Env::get('ENVIRONMENT', '02531348'));
    }

    /**
     * @covers \Litea\Utils\Env::getArray
     * @covers \Litea\Utils\Env::get
     * @covers \Litea\Utils\Env::convert
     */
    public function testCorrectEnvGetArray(): void
    {
        $this->assertIsArray(Env::getArray('EMAILS'));
        $this->assertIsArray(Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));
        $this->assertCount(3, Env::getArray('EMAILS', 'zero;first;second', Env::DELIMITER));

        $this->assertIsArray(Env::getArray('EMAILS', null));
        $this->assertCount(0, Env::getArray('EMAILS', null, Env::DELIMITER));

        $this->assertIsArray(Env::getArray('EMAILS', true));
        $this->assertCount(0, Env::getArray('EMAILS', true, Env::DELIMITER));
        $this->assertIsArray(Env::getArray('ENVIRONMENT', 123456));
    }
}
