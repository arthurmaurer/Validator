<?php
use PHPUnit\Framework\TestCase;
use Validator\ValidatorWrapper;

class ValidatorTest extends TestCase
{
	public function testValidator()
	{
		$v = new ValidatorWrapper(array(
			"user.name" => array(
				array("required"),
			),
			"user.age" => array(
				array("required"),
				array("number")
			),
			"user.email" => array(
				array("email"),
			),
			"payment.method" => array(
				array("in", array("paypal", "cash"))
			),
			"payment.amount" => array(
				array("requiredWith", "payment.method")
			),
			"payment.paypalEmail" => array(
				array("requiredWith", "payment.method", "paypal")
			),
		));


		// All OK
		$result = $v->validate(json_decode('{
			"user": {
				"name": "Arthur",
				"age": 25,
				"email": "mail@mail.mail"
			},
			"payment": {
				"method": "paypal",
				"amount": 100,
				"paypalEmail": "mail@mail.mail"
			}
		}', true));

		$this->assertTrue($result);


		// Bad method
		$result = $v->validate(json_decode('{
			"user": {
				"name": "Arthur",
				"age": 25,
				"email": "mail@mail.mail"
			},
			"payment": {
				"method": "bankTransfer",
				"amount": 100,
				"paypalEmail": "mail@mail.mail"
			}
		}', true));

		$this->assertFalse($result);


		// Bad requireWith with value
		$result = $v->validate(json_decode('{
			"user": {
				"name": "Arthur",
				"age": 25,
				"email": "mail@mail.mail"
			},
			"payment": {
				"method": "paypal",
				"amount": 100
			}
		}', true));

		$this->assertFalse($result);


		// Good requireWith with other value
		$result = $v->validate(json_decode('{
			"user": {
				"name": "Arthur",
				"age": 25,
				"email": "mail@mail.mail"
			},
			"payment": {
				"method": "cash",
				"amount": 100
			}
		}', true));

		$this->assertTrue($result);


		// Bad requireWith without field
		$result = $v->validate(json_decode('{
			"user": {
				"name": "Arthur",
				"age": 25,
				"email": "mail@mail.mail"
			},
			"payment": {
				"method": "cash"
			}
		}', true));

		$this->assertFalse($result);
	}
}