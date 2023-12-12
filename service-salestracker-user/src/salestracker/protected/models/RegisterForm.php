<?php

class RegisterForm extends CFormModel
{
	public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

	public function rules(): array
	{
		return [
			['email, password, confirmPassword', 'required'],
			['email', 'email'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
		];
	}
}