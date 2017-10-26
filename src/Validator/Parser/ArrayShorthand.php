<?php
namespace Validator\Parser;

class ArrayShorthand
{
	public function parseFields(array $fields)
	{
		$output = array();

		foreach ($fields as $field => $tests)
		{
			if (is_array($tests))
			{
				foreach ($tests as $i => $test)
				{
					if (is_array($test))
						$output[$field][] = $test;
					else if (is_string($test))
						$output[$field][] = array($test);
					else
						throw new \Exception("Invalid test data for field $field, test #$i");
				}
			}
			else if (is_string($tests))
			{
				$output[$field] = array(
					array($tests),
				);
			}
			else
				throw new \Exception("Invalid test data for field $field");
		}

		return $output;
	}
}