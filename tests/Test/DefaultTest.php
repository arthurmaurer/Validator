<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class DefaultTest extends TestCase
{
    protected $field;
    protected $mapper;

    public function setUp()
    {
        $this->field = new Field("");
        $this->mapper = new DataMapper(array());
    }

    public function getData()
    {
        return array(
            array(null,     "default",    "default"),
            array("",       "default",    "default"),
            array(false,    "default",    "default"),
            array(true,     "default",    true),
            array("abcd",   "default",    "abcd"),
        );
    }

    /**
     * @dataProvider getData
     */
    public function testAlpha($value, $defaultValue, $expected)
    {
        $test = new Test\DefaultValue(array($defaultValue));

        $result = $test->test($value, $this->field, $this->mapper);
        $this->assertEquals($expected, $result);
    }
}