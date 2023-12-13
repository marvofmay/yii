<?php

class UserService
{
    private User $user;

    public function __construct (
        private readonly string $firstname,
        private readonly string $lastname,
        private readonly string $email,
        private readonly string $birth,
        private readonly string $password,
        private readonly string $datePassword,
        private readonly ?string $created = null,
        private readonly ?string $updated = null,
        private readonly ?string $deleted = null
    ) { }

    public function setUser(): self
    {
        $this->user = new User();
        $this->user->setFirstname($this->firstname);
        $this->user->setLastname($this->lastname);
        $this->user->setEmail($this->email);
        $this->user->setBirth($this->birth);
        $this->user->setPassword($this->password);
        $this->user->setDatePassword($this->datePassword);
        $this->user->setCreated($this->created);

        return $this;
    }

    public function saveUserInDB(): bool
    {
        return $this->user->save();
    }

    public function sendEmail(): self
    {
        $from = Yii::app()->params['adminEmail'];
        $mail = new YiiMailer(
            'confirmRegistrationMail',
            array(
                'login' => $this->email,
                'generatedPassword' => $this->password,
                'description' => 'e-mail confirming registration'
            )
        );
        $mail->setFrom($from, $from);
        $mail->setSubject('E-mail confirming registration.');
        $mail->setTo($this->email);
        if (! $mail->send()) {
            throw new Exception(sprintf('Error while sending email: %s', $mail->getError()));
        }

        return $this;
    }

    public static function checkIfEmailExistsInDB(string $email): bool
    {
        return ! is_null(User::model()->findByAttributes(['email' => $email]));
    }
}