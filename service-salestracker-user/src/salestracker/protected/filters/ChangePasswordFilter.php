<?php

class ChangePasswordFilter extends CFilter
{
    protected function preFilter($filterChain): bool
    {
        $user = Yii::app()->user;
        if ($user->getState('userMustChangePassword')) {
            $controller = $filterChain->controller;
            $controller->redirect(['/user/changePassword']);
        }

        return true;
    }
}