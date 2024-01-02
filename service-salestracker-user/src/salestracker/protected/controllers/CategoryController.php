<?php

class CategoryController extends CController
{
    public array $breadcrumbs = [];

    public function filters(): array
    {
        return [
            ['application.filters.IsUserLoggedInFilter + list'],
        ];
    }

    public function actions(): array
    {
        return [
            'list' => 'application.controllers.category.ListAction',
        ];
    }
}