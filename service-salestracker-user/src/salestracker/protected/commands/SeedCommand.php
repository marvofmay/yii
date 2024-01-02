<?php

require_once './seeders/UserSeeder.php';
require_once './seeders/CategorySeeder.php';
require_once './seeders/PostSeeder.php';
require_once './seeders/PostCategorySeeder.php';
require_once './seeders/CommentPostSeeder.php';
require_once './seeders/ProfileSeeder.php';

class SeedCommand extends \CConsoleCommand
{
    public function actionSeedBySeederName(string $seederName, int $qty = 10)
    {
       switch ($seederName) {
           case 'UserSeeder':
               UserSeeder::seed($qty);
               break;
           case 'CategorySeeder':
               CategorySeeder::seed($qty);
               break;
           case 'PostSeeder':
               PostSeeder::seed($qty);
               break;
           case 'PostCategorySeeder':
               PostCategorySeeder::seed($qty);
               break;
           case 'CommentPostSeeder':
               CommentPostSeeder::seed($qty);
               break;
           case 'ProfileSeeder':
               ProfileSeeder::seed();
               break;
       }
    }
}