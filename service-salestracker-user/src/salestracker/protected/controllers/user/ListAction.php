<?php

class ListAction extends CAction
{
    public function run(): void
    {
        $users = User::model()->findAll();

        $this->getController()->render('list', ['users' => $users]);
    }
}