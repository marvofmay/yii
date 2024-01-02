<?php

require './models/Category.php';

class CategorySeeder
{
    public static function seed(int $qty): void
    {
        for ($i = 0; $i < $qty; $i++) {
            $startDate = strtotime('2023-07-01');
            $endDate = strtotime(date('Y-m-d'));
            $randomTimestampCreated = mt_rand($startDate, $endDate);
            $randomTimestampDeleted = mt_rand($randomTimestampCreated, $endDate);

            $category = new Category();
            $category->setName('name ' . $i + 1);
            $category->setDescription('description ' . $i + 1);
            $category->setActive(rand(0, 1));
            $category->setCreated(date('Y-m-d H:i:s', $randomTimestampCreated));
            $category->setDeleted(rand(0, 1) ? date('Y-m-d H:i:s', $randomTimestampDeleted) : null);
            $category->save();
        }
    }
}