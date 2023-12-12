<?php

class UserController extends CController
{
    public array $breadcrumbs = [];

    public function filters(): array
    {
        return [
            ['application.filters.ChangePasswordFilter + list, uploadXLS'],
            ['application.filters.IsUserLoggedInFilter + list, uploadXLS, changePassword, logout'],
        ];
    }

    public function actions(): array
    {
        return [
            'register' => 'application.controllers.user.RegisterAction',
            'login' => 'application.controllers.user.LoginAction',
            'logout' => 'application.controllers.user.LogoutAction',
            'list' => 'application.controllers.user.ListAction',
            'uploadXLS' => 'application.controllers.user.UploadXLSAction',
            'changePassword' => 'application.controllers.user.ChangePasswordAction',
        ];
    }
}