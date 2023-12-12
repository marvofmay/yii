<?php

class RegisterAction extends CAction
{
    public function run()
    {
        $model = new RegisterForm;
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate()) {
                $existingUser = User::model()->findByAttributes(['email' => $model->email]);
                if ($existingUser !== null) {
                    $model->addError('email', 'This email already exists in the database.');
                } else {
                    $newUser = new User;
                    $newUser->setEmail($model->email);
                    $newUser->setPassword($model->password);
                    $newUser->setCreated(date('Y-m-d H:i:s'));
                    $newUser->setDatePassword(date('Y-m-d'));
                    $newUser->save();

                    Yii::app()->user->setFlash('register', 'Thank you for your registration. You can log in now.');
                }
            }
        }

        $this->getController()->render('register', ['model' => $model]);
    }
}