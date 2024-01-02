<?php

require_once './models/Post.php';
require_once './models/Category.php';
require_once './models/PostCategory.php';

class PostCategorySeeder
{
    private static function getPosts(): array
    {
        return Post::model()->findAll();
    }

    private static function getCategories(): array
    {
        return Category::model()->findAll();
    }

    public static function seed(): void
    {
        $posts = self::getPosts();
        $categories = self::getCategories();

        foreach ($posts as $post) {
            $qty = rand(1, 10);
            $category = [];
            for ($i = 0; $i < $qty; $i++) {
                $categoryKey = array_rand($categories);
                if (isset($category[$categoryKey])) {
                    continue;
                }
                $category[$categoryKey] = $categories[$categoryKey];
                $postCategory = new PostCategory();
                $postCategory->setPostId($post->getId());
                $postCategory->setCategoryId($category[$categoryKey]->getId());
                $postCategory->save();
            }
        }
    }
}