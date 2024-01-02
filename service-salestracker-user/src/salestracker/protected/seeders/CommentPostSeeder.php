<?php

require_once './models/Post.php';
require_once './models/Comment.php';
require_once '../../vendor/fzaninotto/faker/src/autoload.php';

class CommentPostSeeder
{
    private static function getPosts(): array
    {
        return Post::model()->findAll();
    }

    public static function seed(int $qty): void
    {
        $posts = self::getPosts();
        $faker = Faker\Factory::create('pl_PL');

        foreach ($posts as $post) {
            $qty = rand(0, 20);
            for ($i = 0; $i < $qty; $i++) {
                $startDate = strtotime($post->getCreated());
                $endDate = strtotime(date('Y-m-d'));
                $randomTimestampCreated = mt_rand($startDate, $endDate);

                $comment = new Comment();
                $comment->setContent('Comment\'s (' . ($i + 1) . ') post (' . $post->getId() . ').');
                $comment->setPostId($post->getId());
                $comment->setCreated(date('Y-m-d H:i:s', $randomTimestampCreated));
                $comment->setDeleted($post->getDeleted());
                $comment->save();
            }
        }
    }
}