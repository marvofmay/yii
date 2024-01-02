<?php

class Profile extends CActiveRecord
{
    public array $primaryKey = ['id'];
    public ?int $id = null;
    public ?string $avatar;
    public ?string $www;
    public int $user_id;
    public ?string $created = null;
    public ?string $updated = null;
    public ?string $deleted = null;

    public function tableName()
    {
        return 'profile';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return [
            'user' => [
                self::BELONGS_TO,
                'User',
                'user_id'
            ],
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getWWW(): ?string
    {
        return $this->www;
    }

    public function setWWW(?string $www): void
    {
        $this->www = $www;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->created = $created;
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
}
