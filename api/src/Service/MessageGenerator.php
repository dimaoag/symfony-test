<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Log\LoggerInterface;

final class MessageGenerator
{
    private LoggerInterface $logger;
    private string $adminEmail;

    public function __construct(LoggerInterface $logger, string $adminEmail)
    {
        $this->logger = $logger;
        $this->adminEmail = $adminEmail;
    }

    public function getHappyMessage(): string
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
            $this->adminEmail,
        ];

        $index = array_rand($messages);
        $message = $messages[$index];

        $this->logger->info($message);

        return $message;
    }
}