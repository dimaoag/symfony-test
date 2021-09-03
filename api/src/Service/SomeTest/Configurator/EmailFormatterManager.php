<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Configurator;

final class EmailFormatterManager
{
    public function getEnabledFormatters(): array
    {
        // код для конфигурации того, какие программы форматирования использовать
        $enabledFormatters = [];

        // ...

        return $enabledFormatters;
    }
}