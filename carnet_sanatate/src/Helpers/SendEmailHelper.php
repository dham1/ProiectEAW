<?php


namespace App\Helpers;

class SendEmailHelper
{
    private $apiKey= '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';
    private $fromMail = "testphp@mail.com";
    private $fromName = "Test PHP";

    public function sendMail($toMail, $toName, $subject, $content)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->fromMail, $this->fromName);
        $email->setSubject($subject);
        $email->addTo($toMail, $toName);
        $email->addContent("text/html", $content);
        $sendgrid = new \SendGrid($this->apiKey);

        try
        {
            $response = $sendgrid->send($email);
            return $response->statusCode();
        }
        catch (Exception $e)
        {
            return 'Caught exception: '. $e->getMessage();
        }
    }
}