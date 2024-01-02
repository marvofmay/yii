<?php

class PostCategory extends CActiveRecord
{
    public int $post_id;
    public int $category_id;

    public function tableName()
    {
        return 'post_category';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return [
            'post' => [
                self::BELONGS_TO,
                'Post',
                'post_id'
            ],
            'category' => [
                self::BELONGS_TO,
                'Category',
                'category_id'
            ],
        ];
    }

    public function getPostId(): int
    {
        return $this->post_id;
    }

    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}
