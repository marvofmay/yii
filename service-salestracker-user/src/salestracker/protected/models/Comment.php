<?php

class Comment extends CActiveRecord
{
    public array $primaryKey = ['id'];
    public ?int $id = null;
    public string $content;
    public int $post_id;
    public ?string $created = null;
    public ?string $updated = null;
    public ?string $deleted = null;

    public function tableName()
    {
        return 'comment';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function rules()
	{
		return [
			['content', 'required'],
		];
	}

    public function relations()
    {
        return [
            'user' => [
                self::BELONGS_TO,
                'Post',
                'post_id'
            ],
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPostId(): int
    {
        return $this->post_id;
    }

    public function setPostId(int $postId): void
    {
        $this->post_id = $postId;
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
