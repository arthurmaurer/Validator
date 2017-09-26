<?php
namespace Validator;
use Validator\Validator;
use Validator\Test;

class Translator
{
	public static $messages = array();
	public static $locale = "en_GB";
	public static $v;

	public static function getError($error)
	{
		$formattedMessage = self::getFormattedMessage($error["field"], $error["test"]);

		return $formattedMessage;
	}

	public static function getErrors(Validator $v)
	{
		self::$v = $v;

		$messages = array();

		foreach ($v->getErrors() as $error)
		{
			$fieldName = $error["field"]->name;
			$messages[$fieldName][] = self::getError($error);
		}

		return $messages;
	}

	public static function getLabel(Field $field)
	{
		if (isset(self::$v->labels[$field->name]))
			return self::$v->labels[$field->name];

		return $field->name;
	}

	public static function getMessage(Test $test)
	{
		$testName = $test->getName();

		if (isset(self::$messages[$testName]))
			return self::$messages[$testName];

		return "'__field__' failed test '". $test->getName() ."'";
	}

	public static function getFormattedMessage(Field $field, Test $test)
	{
		$message = self::getMessage($test);

		$replacements = array(
			"__field__" => self::getLabel($field)
		);

		foreach ($replacements as $pattern => $replacement)
			$message = str_replace($pattern, $replacement, $message);

		foreach ($test->params as $i => $param)
			$message = str_replace("__". $i ."__", $param, $message);

		return $message;
	}

	public static function addTranslation(Test $test)
	{
		$trans = $test->getTranslation();
		$name = $test->getName();

		if (isset($trans[self::$locale]))
			self::$messages[$name] = $trans[self::$locale];
	}
}