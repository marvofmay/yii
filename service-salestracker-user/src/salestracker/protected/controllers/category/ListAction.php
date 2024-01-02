<?php

class ListAction extends CAction
{
    public function run(): void
    {
        $categories = [];

        try {
            $categories = Category::model()->with('posts')->findAll();
        } catch (Exception $exception) {
            Yii::app()->user->setFlash('errors', $exception->getMessage());
        }

        $this->getController()->render('list', ['categories' => $categories]);
    }
}