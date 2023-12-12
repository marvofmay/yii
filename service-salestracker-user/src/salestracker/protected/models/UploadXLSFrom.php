<?php

class UploadXLSFrom extends CFormModel
{
    public $file;

    public function rules(): array
    {
        return [
            ['file', 'file', 'types' => 'xls, xlsx', 'allowEmpty' => false],
        ];
    }
}