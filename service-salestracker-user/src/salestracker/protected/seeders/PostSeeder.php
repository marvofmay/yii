<?php

require_once './models/User.php';
require_once './models/Post.php';

class PostSeeder
{
    private static function getUsers(): array
    {
        return User::model()->findAll();
    }

    public static function seed(int $qty): void
    {
        $users = self::getUsers();
        for ($i = 0; $i < $qty; $i++) {
            $user = $users[array_rand($users)];
            $endDate = strtotime(date('Y-m-d'));
            $randomTimestampCreated = mt_rand(strtotime($user->getCreated()), $endDate);

            $post = new Post();
            $post->setTitle('title ' . $i + 1);
            $post->setDescription('description ' . $i + 1);
            $post->setContent('content ' . $i + 1);
            $post->setActive(rand(0, 1));
            $post->setUserId($user->getId());
            $post->setCreated(date('Y-m-d H:i:s', $randomTimestampCreated));
            $post->setDeleted($user->getDeleted());
            $post->save();
        }
    }
}