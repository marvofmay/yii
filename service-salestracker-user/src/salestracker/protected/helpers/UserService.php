<?php

class UserService
{
    private User $user;
    public function __construct (
        private readonly ?string $firstname,
        private readonly ?string $lastname,
        private readonly string $email,
        private readonly ?string $birth,
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

    public static function checkIfEmailExistsInDB(string $email): bool
    {
        return ! is_null(User::model()->findByAttributes(['email' => $email]));
    }
}