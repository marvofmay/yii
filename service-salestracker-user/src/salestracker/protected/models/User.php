<?php

class User extends CActiveRecord
{
    public const CHANGE_PASSWORD_AFTER_DAYS = 5;

    public array $primaryKey = ['id'];
    public ?int $id = null;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public string $email = '';
    public ?string $birth = null;
    public string $password = '';
    public ?string $datePassword = null;
    public ?string $created = null;
    public ?string $updated = null;
    public ?string $deleted = null;

    public function tableName()
    {
        return 'user';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function rules()
	{
		return [
			['email, password', 'required'],
			['email', 'email'],
		];
	}

    public function relations()
    {
        return [
            'posts' => [self::HAS_MANY, 'Post', 'user_id'],
            'profile'=> [self::HAS_ONE, 'Profile', 'user_id'],
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getBirth(): ?string
    {
        return $this->birth;
    }

    public function setBirth(?string $birth): void
    {
        $this->birth = $birth;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = CPasswordHelper::hashPassword($password);
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->created = $created;
    }

    public function getDatePassword(): ?string
    {
        return $this->datePassword;
    }

    public function setDatePassword(?string $datePassword): void
    {
        $this->datePassword = $datePassword;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    public function setUpdated(?string $updated): void
    {
        $this->updated = $updated;
    }

    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    public function setDeleted(?string $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function isNewPasswordIsDifferentFromCurrent(int $id, string $newPassword): bool
    {
        $user = $this->findByPk($id);

        return CPasswordHelper::verifyPassword($newPassword, $user->getPassword());
    }

    public function isUserMustChangePassword(int $id): bool
    {
        $user = $this->findByPk($id);
        $oldDate = new DateTime($user->getDatePassword());
        $today = new DateTime();

        return $oldDate->diff($today)->days >= self::CHANGE_PASSWORD_AFTER_DAYS;
    }
}
