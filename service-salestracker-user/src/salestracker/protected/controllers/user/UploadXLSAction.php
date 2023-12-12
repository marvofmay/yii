<?php

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
require './protected/extensions/YiiMailer/YiiMailer.php';

class UploadXLSAction extends CAction
{
    private array $sheetData = [];

    public function run(): void
    {
        $model = new UploadXLSFrom;
        if (! empty($_FILES['UploadXLSFrom'])) {
            $model->attributes = $_FILES['UploadXLSFrom'];
            $model->file = CUploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $spreadsheet = IOFactory::load($_FILES['UploadXLSFrom']['tmp_name']['file']);
                $this->sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                try {
                    $this->checkIfEmailExistsInDB();
                    $this->saveUsers();
                } catch (Exception $e) {
                    Yii::app()->user->setFlash('uploadXLSError', $e->getMessage());
                }
            }
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
            $user = new User();
            $user->setFirstname($row['A']);
            $user->setLastname($row['B']);
            $user->setEmail($email);
            $user->setBirth($row['D']);
            $user->setPassword($generatedPassword);
            $user->setCreated(date('Y-m-d H:i:s'));
            $user->setDatePassword(date('Y-m-d'));
            $user->save();
            $this->sendEmail($email, $generatedPassword);
        }

        Yii::app()->user->setFlash('uploadXLSSuccess', 'Upload XLS with success.');
    }

    private function sendEmail(string $email, string $generatedPassword): void
    {
        $from = Yii::app()->params['adminEmail'];
        $mail = new YiiMailer(
            'confirmRegistrationMail',
            array(
                'login' => $email,
                'generatedPassword' => $generatedPassword,
                'description' => 'e-mail confirming registration'
            )
        );
        $mail->setFrom($from, $from);
        $mail->setSubject('E-mail confirming registration.');
        $mail->setTo($email);
        if (! $mail->send()) {
            throw new Exception(sprintf('Error while sending email: %s', $mail->getError()));
        }
    }
}