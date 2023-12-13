<?php

class RegisterAction extends CAction
{
    public function run()
    {
        try {
            $model = new RegisterForm;
            if (isset($_POST['RegisterForm'])) {
                $model->attributes = $_POST['RegisterForm'];
                if ($model->validate()) {
                    $existingUser = User::model()->findByAttributes(['email' => $model->email]);
                    if ($existingUser !== null) {
                        $model->addError('email', 'This email already exists in the database.');
                    } else {
                          $userService = new UserService(
                              null,
                              null,
                              $model->email,
                              null,
                              $model->password,
                              date('Y-m-d'),
                              date('Y-m-d H:i:s')
                          );
                          $userService->setUser()->saveUserInDB();
                        Yii::app()->user->setFlash('register', 'Thank you for your registration. You can log in now.');
                    }
                }
            }
        } catch (Exception $exception) {
            Yii::app()->user->setFlash('errors', $exception->getMessage());
        }
        $this->getController()->render('register', ['model' => $model]);
    }
}