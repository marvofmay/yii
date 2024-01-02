<?php
class EmailService
{
    public function __construct (
        private readonly string $email,
        private readonly string $viewName,
        private readonly array $viewParams
    ) { }
    public function sendEmail(): self
    {
        $from = Yii::app()->params['adminEmail'];
        $mail = new YiiMailer($this->viewName, $this->viewParams);
        $mail->setFrom($from, $from);
        $mail->setSubject('E-mail confirming registration.');
        $mail->setTo($this->email);
        if (! $mail->send()) {
            throw new Exception(sprintf('Error while sending email: %s', $mail->getError()));
        }

        return $this;
    }
}