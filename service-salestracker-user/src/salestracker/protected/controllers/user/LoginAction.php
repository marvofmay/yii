<?php

class LoginAction extends CAction
{
    public function run(): void
    {
        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if($model->validate() && $model->login()) {
                if (User::model()->isUserMustChangePassword(Yii::app()->user->getId())) {
                    Yii::app()->user->setState('userMustChangePassword', true);
                }
                $this->getController()->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->getController()->render('login', ['model' => $model]);
    }
}