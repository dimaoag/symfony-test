<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Transformer;

interface TransformerInterface
{
    public function transform(string $value): string;

}