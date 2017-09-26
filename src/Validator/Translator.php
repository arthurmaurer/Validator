<?php
namespace Validator;
use Validator\Validator;
use Validator\Test;

class Translator
{
	public $locale = "en_GB";

	public function translateErrors(array $errors)
	{
		$errorStrings = array();

		foreach ($errors as $error)
		{
			$key = $error["field"]->name;
			$errorStrings[$key] = $this->translateError($error);
		}

		return $errorStrings;
	}

	public function translateError(array $error)
	{
		$message = $error["test"]->translate($error["field"], $error["error"], $this->locale);

		return $message;
	}
}