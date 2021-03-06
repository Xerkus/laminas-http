<?php

/**
 * @see       https://github.com/laminas/laminas-http for the canonical source repository
 * @copyright https://github.com/laminas/laminas-http/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-http/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Http\Header;

use Laminas\Http\Header\Exception\InvalidArgumentException;
use Laminas\Http\Header\HeaderValue;
use PHPUnit\Framework\TestCase;

class HeaderValueTest extends TestCase
{
    /**
     * Data for filter value
     */
    public function getFilterValues()
    {
        return [
            ["This is a\n test", 'This is a test'],
            ["This is a\r test", 'This is a test'],
            ["This is a\n\r test", 'This is a test'],
            ["This is a\r\n  test", 'This is a  test'],
            ["This is a \r\ntest", 'This is a test'],
            ["This is a \r\n\n test", 'This is a  test'],
            ["This is a\n\n test", 'This is a test'],
            ["This is a\r\r test", 'This is a test'],
            ["This is a \r\r\n test", 'This is a  test'],
            ["This is a \r\n\r\ntest", 'This is a test'],
            ["This is a \r\n\n\r\n test", 'This is a  test'],
        ];
    }

    /**
     * @group ZF2015-04
     *
     * @dataProvider getFilterValues
     *
     * @param string $value
     * @param string $expected
     */
    public function testFiltersValuesPerRfc7230($value, $expected)
    {
        $this->assertEquals($expected, HeaderValue::filter($value));
    }

    public function validateValues()
    {
        return [
            ["This is a\n test", 'assertFalse'],
            ["This is a\r test", 'assertFalse'],
            ["This is a\n\r test", 'assertFalse'],
            ["This is a\r\n  test", 'assertFalse'],
            ["This is a \r\ntest", 'assertFalse'],
            ["This is a \r\n\n test", 'assertFalse'],
            ["This is a\n\n test", 'assertFalse'],
            ["This is a\r\r test", 'assertFalse'],
            ["This is a \r\r\n test", 'assertFalse'],
            ["This is a \r\n\r\ntest", 'assertFalse'],
            ["This is a \r\n\n\r\n test", 'assertFalse'],
        ];
    }

    /**
     * @group ZF2015-04
     *
     * @dataProvider validateValues
     *
     * @param string $value
     * @param string $assertion
     */
    public function testValidatesValuesPerRfc7230($value, $assertion)
    {
        $this->{$assertion}(HeaderValue::isValid($value));
    }

    public function assertValues()
    {
        return [
            ["This is a\n test"],
            ["This is a\r test"],
            ["This is a\n\r test"],
            ["This is a \r\ntest"],
            ["This is a \r\n\n test"],
            ["This is a\n\n test"],
            ["This is a\r\r test"],
            ["This is a \r\r\n test"],
            ["This is a \r\n\r\ntest"],
            ["This is a \r\n\n\r\n test"],
        ];
    }

    /**
     * @group ZF2015-04
     *
     * @dataProvider assertValues
     *
     * @param string $value
     */
    public function testAssertValidRaisesExceptionForInvalidValue($value)
    {
        $this->expectException(InvalidArgumentException::class);
        HeaderValue::assertValid($value);
    }
}
