<?php
namespace Acme\Test\TestCase;

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    /**
     * Test method
     *
     * @return void
     */
    public function testEqual()
    {
        $string = 'ABC';
        $expected = 'ABC';
        $this->assertEquals($expected, $string);
    }
}
