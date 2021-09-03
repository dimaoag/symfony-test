<?php

declare(strict_types=1);

namespace App\Service\SomeTest\SiteUpdate;

use App\Service\SomeTest\SiteUpdate\MessageGenerator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SiteUpdateManager
{
    private MessageGenerator $messageGenerator;
    private MailerInterface $mailer;
    private string $adminEmail;

    public function __construct(MessageGenerator $messageGenerator, MailerInterface $mailer, string $adminEmail)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function notifyOfSiteUpdate(): bool
    {
        $happyMessage = $this->messageGenerator->getHappyMessage();

        $email = (new Email())
            ->from('admin@example.com')
            ->to($this->adminEmail)
            ->subject('Site update just happened!')
            ->text('Someone just updated the site. We told them: '.$happyMessage);

        $this->mailer->send($email);

        // ...

        return true;
    }
}