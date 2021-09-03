<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Configurator;

final class EmailConfigurator
{
    private $formatterManager;

    public function __construct(EmailFormatterManager $formatterManager)
    {
        $this->formatterManager = $formatterManager;
    }

    public function configure(EmailFormatterAwareInterface $emailManager): void
    {
        $emailManager->setEnabledFormatters(
            $this->formatterManager->getEnabledFormatters()
        );
    }

    // ...
}