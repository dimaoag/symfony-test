<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Configurator;

final class GreetingCardManager implements EmailFormatterAwareInterface
{
    private ?array $enabledFormatters = null;

    public function setEnabledFormatters(array $enabledFormatters): void
    {
        $this->enabledFormatters = $enabledFormatters;
    }
}