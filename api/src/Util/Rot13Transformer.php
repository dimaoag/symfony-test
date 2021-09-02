<?php

declare(strict_types=1);

namespace App\Util;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

final class Rot13Transformer implements TransformerInterface
{
    private ?LoggerInterface $logger;

    public function transform(string $value): string
    {
        $this->logger?->info($value);

        return str_rot13($value);
    }

    #[Required]  // autowire
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}