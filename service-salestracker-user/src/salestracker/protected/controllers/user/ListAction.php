<?php

class ListAction extends CAction
{
    public function run(): void
    {
        try {
            $users = User::model()->findAll();
        } catch (Exception $exception) {
            Yii::app()->user->setFlash('errors', $exception->getMessage());
        }

        $this->getController()->render('list', ['users' => $users]);
    }
}