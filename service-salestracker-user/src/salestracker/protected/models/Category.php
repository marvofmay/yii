<?php

class Category extends CActiveRecord
{
    public array $primaryKey = ['id'];
    public ?int $id = null;
    public string $name;
    public string $description;
    public bool $active = true;
    public ?string $created = null;
    public ?string $updated = null;
    public ?string $deleted = null;

    public function tableName()
    {
        return 'category';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function rules()
	{
		return [
			['name', 'required'],
		];
	}

    public function relations()
    {
        return [
            'posts' => [
                self::MANY_MANY,
                'Post',
                'post_category(category_id, post_id)'
            ],
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
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
