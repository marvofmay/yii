<?php

require_once '../../vendor/fzaninotto/faker/src/autoload.php';
require_once './models/User.php';

class UserSeeder
{
    public static function seed(int $qty): void
    {
        $faker = Faker\Factory::create('pl_PL');
        for ($i = 0; $i < $qty; $i++) {
            $startDate = strtotime('2023-07-01');
            $endDate = strtotime(date('Y-m-d'));
            $randomTimestampCreated = mt_rand($startDate, $endDate);
            $randomTimestampDeleted = mt_rand($randomTimestampCreated, $endDate);
            $randomTimestampBirth = mt_rand(strtotime('1977-01-01'), strtotime('1980-12-31'));

            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setBirth(date('Y-m-d', $randomTimestampBirth));
            $user->setPassword('qwerty');
            $user->setDatePassword(date('Y-m-d'));
            $user->setCreated(date('Y-m-d H:i:s', $randomTimestampCreated));
            $user->setDeleted(rand(0, 1) ? date('Y-m-d H:i:s', $randomTimestampDeleted) : null);
            $user->save();
        }
    }
}