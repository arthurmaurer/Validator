<?php
namespace Validator;

class Field
{
	public $name;
	public $label;
	public $tests = array();

	public function __construct($name)
	{
		$this->name = $name;
		$this->label = $name;
	}
}