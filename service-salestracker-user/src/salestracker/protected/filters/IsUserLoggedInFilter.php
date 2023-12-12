<?php

class IsUserLoggedInFilter extends CFilter
{
    protected function preFilter($filterChain): bool
    {
        if (Yii::app()->user->isGuest) {
            $controller = $filterChain->controller;
            $controller->redirect(['/site/index']);
        }

        return true;
    }
}