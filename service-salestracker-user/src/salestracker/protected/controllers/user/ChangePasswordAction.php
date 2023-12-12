<?php

class ChangePasswordAction extends CAction
{
    public function run()
    {
        $model = new ChangePasswordForm;
        if(isset($_POST['ChangePasswordForm'])) {
            $model->attributes = $_POST['ChangePasswordForm'];
            if ($model->validate()) {
                $isNewPasswordIsDifferentFromCurrent = User::model()->isNewPasswordIsDifferentFromCurrent(Yii::app()->user->id, $model->newPassword);

                if ($isNewPasswordIsDifferentFromCurrent) {
                    $model->addError('newPassword', 'The new password cannot be the same as the current one.');
                } else {
                    $user = User::model()->findByPk(Yii::app()->user->getId());
                    $user->setPassword($model->newPassword);
                    $user->setDatePassword(date('Y-m-d'));
                    $user->save();
                    Yii::app()->user->setState('userMustChangePassword', false);
                    Yii::app()->user->setFlash('changePassword', 'Password has been changed.');
                }
            }
        }

        $this->getController()->render('changePassword', ['model' => $model]);
    }
}