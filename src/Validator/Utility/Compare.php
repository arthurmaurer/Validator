<?php
namespace Validator\Utility;

class Compare
{
	public static function compare($a, $b, $type)
	{
		if ($type instanceof \DateTime)
			return self::compareDate($a, $b);
		else if (is_numeric($type))
			return self::compareNumber($a, $b);
		else
			return false;
	}

	public static function compareNumber($a, $b)
	{
		if (!is_numeric($a))
			return false;

		return ($a - $b);
	}

	public static function compareDate(\DateTime $a, \DateTime $b)
	{
		return ($a->getTimestamp() - $b->getTimestamp());
	}
}