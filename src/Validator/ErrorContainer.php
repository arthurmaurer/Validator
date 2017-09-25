<?php
namespace Validator;

class ErrorContainer
{
	public $errors = array();

	public function count()
	{
		return count($this->errors);
	}

	public function add($element)
	{
		$this->errors[] = $element;
	}

	public function clear()
	{
		$this->errors = array();
	}
}