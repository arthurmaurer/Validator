<?php
namespace Validator\DataMapper;

class ResultCollection
{
	public $results;

	public function __construct(array $results = array())
	{
		$this->results = $results;
	}
}