<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadXLSAction extends CAction
{
    private array $sheetData = [];

    public function run(): void
    {
        try {
            $model = new UploadXLSFrom;
            if (!empty($_FILES['UploadXLSFrom'])) {
                $model->attributes = $_FILES['UploadXLSFrom'];
                $model->file = CUploadedFile::getInstance($model, 'file');

                if ($model->validate()) {
                    $spreadsheet = IOFactory::load($_FILES['UploadXLSFrom']['tmp_name']['file']);
                    $this->sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    $this->checkIfEmailExistsInDB();
                    $this->saveUsers();
                }
            }
        } catch (Exception $exception) {
            Yii::app()->user->setFlash('uploadXLSError', $exception->getMessage());
        }

        $this->getController()->render('uploadXLS', ['model' => $model]);
    }

    private function checkIfEmailExistsInDB (): void
    {
        foreach ($this->sheetData as $key => $row) {
            if ($key === 1) {
                continue;
            }
            $email = $row['C'];
            if (User::model()->findByAttributes(['email' => $email])) {
                throw new Exception(sprintf('User with email "%s" exists.', $email));
            }
        }
    }

    private function saveUsers(): void
    {
        foreach ($this->sheetData as $key => $row) {
            if ($key === 1) {
                continue;
            }
            $email = $row['C'];
            $generatedPassword = substr(md5(mt_rand()), 0, 7);
            $userService = new UserService(
                $row['A'],
                $row['B'],
                $email,
                $row['D'],
                $generatedPassword,
                date('Y-m-d'),
                date('Y-m-d H:i:s')
            );

            if ($userService->setUser()->saveUserInDB()) {
                $userService->sendEmail();
            }
        }

        Yii::app()->user->setFlash('uploadXLSSuccess', 'Upload XLS with success.');
    }
}