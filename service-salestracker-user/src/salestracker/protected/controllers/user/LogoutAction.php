<?php

class LogoutAction extends CAction
{
    public function run(): void
    {
        Yii::app()->user->logout();
        $this->getController()->redirect(Yii::app()->homeUrl);
    }
}