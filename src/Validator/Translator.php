<?php
namespace Validator;
use Validator\Validator;
use Validator\Test;

class Translator
{
	protected static $instance;

	public $locale = "en_GB";
	public $v;

	public static function instance()
	{
		if (!self::$instance)
			self::$instance = new self;

		return self::$instance;
	}

	protected function __construct()
	{
	}

	public static function getErrors(Validator $v)
	{
		$instance = self::instance();
		$errors = $v->getErrors();
		$errorStrings = array();

		foreach ($errors as $error)
		{
			$key = $error["field"]->name;
			$errorStrings[$key] = $instance->getError($error);
		}

		return $errorStrings;
	}

	public function getError(array $error)
	{
		$message = $error["test"]->translate($error["field"], $error["error"], $this->locale);

		return $message;
	}
}