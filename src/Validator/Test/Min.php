<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;
use Validator\Utility\Compare;

class Min extends Test
{
	const PARAM_LIMIT = 0;
	const PARAM_EXCLUSIVE = 1;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		$limit = $this->params[self::PARAM_LIMIT];
		$exclusive = (isset($this->params[self::PARAM_EXCLUSIVE]))
			? (bool) $this->params[self::PARAM_EXCLUSIVE]
			: false;

		$cmp = Compare::compare($value, $limit, $limit);

		if ($cmp === false)
			return false;

		if ($exclusive)
			return ($cmp > 0);

		return ($cmp >= 0);
	}

	public function getName()
	{
		return "min";
	}

	public function translate(Field $field, $error, $locale)
	{
		$orEqual = (isset($this->params[self::PARAM_EXCLUSIVE]) && $this->params[self::PARAM_EXCLUSIVE])
			? ""
			: " or equal";
		$limit = $this->params[self::PARAM_LIMIT];

		if ($limit instanceof \DateTime)
			$limit = $limit->format("d-m-Y H:i");

		return "$field->label must be greater$orEqual than $limit";
	}
}