<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Configurator;

interface EmailFormatterAwareInterface
{
    public function setEnabledFormatters(array $enabledFormatters): void;
}