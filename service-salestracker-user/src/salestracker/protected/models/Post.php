<?php

class Post extends CActiveRecord
{
    public array $primaryKey = ['id'];
    public ?int $id = null;
    public string $title;
    public string $description;
    public string $content;
    public bool $active = true;
    public int $user_id;
    public ?string $created = null;
    public ?string $updated = null;
    public ?string $deleted = null;

    public function tableName()
    {
        return 'post';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function rules()
	{
		return [
			['title', 'required'],
		];
	}

    public function relations()
    {
        return [
            'user' => [
                self::BELONGS_TO,
                'User',
                'user_id'
            ],
            'categories' => [
                self::MANY_MANY,
                'Category',
                'post_category(post_id, category_id)'
            ],
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
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
