<?php
namespace Validator;
use Validator\Validator;
use Validator\Test;

class Translator
{
	public static $locale = "en_US";

	public function translateErrors(array $errors, $locale)
	{
		$errorStrings = array();

		foreach ($errors as $error)
		{
			$key = $error["field"]->name;
			$errorStrings[$key] = $this->translateError($error, $locale);
		}

		return $errorStrings;
	}

	public function translateError(array $error, $locale)
	{
		if (!$locale)
			$locale = self::$locale;

		$message = $error["test"]->translate($error["field"], $error["error"], $locale);

		return $message;
	}
}