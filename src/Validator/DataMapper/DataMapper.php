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
		return $this->internalGet($path, $this->data);
	}

	protected function internalGet($path, $object)
	{
		list($root, $rest) = $this->getPathRoot($path);

		if ($root === "*")
		{
			$results = array();

			foreach ($object as $i => $child)
			{
				$results[$i] = ($rest)
					? $this->internalGet($rest, $child)
					: $child;
			}

			return new ResultCollection($results);
		}

		if (array_key_exists($root, $object))
		{
			$target = $object[$root];

			if ($rest === "" || !is_array($target))
				return $target;

			return $this->internalGet($rest, $target);
		}

		return new NoResult;
	}

	public function set($path, $value)
	{
		return $this->internalSet($path, $value, $this->data);
	}

	protected function internalSet($path, $value, &$object)
	{
		list($root, $rest) = $this->getPathRoot($path);

		if ($rest === "")
		{
			$object[$root] = $value;

			return true;
		}
		else if (array_key_exists($root, $object))
			return $this->internalSet($rest, $value, $object[$root]);

		return false;
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