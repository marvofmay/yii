<?php

class ChangePasswordForm extends CFormModel
{
    public string $newPassword = '';
    public string $confirmNewPassword = '';

	public function rules(): array
	{
		return [
			['newPassword, confirmNewPassword', 'required'],
            ['confirmNewPassword', 'compare', 'compareAttribute' => 'newPassword'],
		];
	}
}