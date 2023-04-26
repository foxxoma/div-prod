<?php

namespace App\Help;

class Email
{
	private $email_from = 'test@test.com';
	public $email = false;
	public $message = false;

	public function __construct($email, $message)
	{
		$this->email = $email;
		$this->message = $message;
	}

	public function send()
	{
		return [
			'success' => true,
			'send_at' => date('Y.m.d H:i:s')
		];
	}
}
