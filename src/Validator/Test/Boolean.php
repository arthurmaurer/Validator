<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Boolean extends Test
{
    const TRUE_VALUES = ['true', true, '1', 1, 'yes'];
    const FALSE_VALUES = ['false', false, '0', 0, 'no', 'null', ''];

	public function test($value, Field $field, DataMapper $dataMapper)
	{
	    if (is_bool($value)) {
	        return true;
        }

	    return ($this->isTrue($value) || $this->isFalse($value));
	}

	public function sanitizeOutput($value)
    {
        if ($this->isFalse($value)) {
            return false;
        }

        return true;
    }

    public function getName()
	{
		return ['boolean', 'bool'];
	}

	public function translate(Field $field, $error, $locale)
	{
		return $field->label .' should be a boolean';
	}

	protected function isTrue($value)
    {
        return in_array((string)$value, self::TRUE_VALUES, true);
    }

	protected function isFalse($value)
    {
        return in_array((string)$value, self::FALSE_VALUES, true);
    }
}