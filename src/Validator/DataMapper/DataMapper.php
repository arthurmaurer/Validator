<?php
namespace Validator\DataMapper;
use Validator\DataMapper\NoResult;

class DataMapper
{
	protected $data = array();


	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function get($path)
	{
		return $this->realGet($path, $this->data);
	}

	protected function realGet($path, $object)
	{
		list($root, $rest) = $this->getPathRoot($path);

		if ($root === "*")
		{
			$results = array();

			foreach ($object as $i => $child)
			{
				$results[$i] = ($rest)
					? $this->realGet($rest, $child)
					: $child;
			}

			return new ResultCollection($results);
		}

		if (array_key_exists($root, $object))
		{
			$target = $object[$root];

			if ($rest === "" || !is_array($target))
				return $target;

			return $this->realGet($rest, $target);
		}

		return new NoResult;
	}

	protected function getPathRoot($path)
	{
		$i = strpos($path, ".");

		// There is no ".", hence the root is the whole $path
		if ($i === false)
			return array($path, "");

		$root = substr($path, 0, $i);
		$rest = substr($path, $i + 1);

		return array($root, $rest);
	}
}