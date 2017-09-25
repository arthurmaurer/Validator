<?php
namespace Validator;

class Field
{
	public $name;
	public $tests = array();

	public function __construct($name)
	{
		$this->name = $name;
	}
}