<?php

require_once './models/User.php';
require_once './models/Profile.php';

class ProfileSeeder
{
    private static function getUsers(): array
    {
        return User::model()->findAll();
    }

    public static function seed(): void
    {
        $users = self::getUsers();
        foreach ($users as $key => $user) {
            $profile = new Profile();
            $profile->setAvatar(null);
            $profile->setWWW('www ' . $key + 1);
            $profile->setUserId($user->getId());
            $profile->setCreated($user->getCreated());
            $profile->setDeleted($user->getDeleted());
            $profile->save();
        }
    }
}