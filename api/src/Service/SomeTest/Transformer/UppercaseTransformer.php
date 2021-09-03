<?php

declare(strict_types=1);

namespace App\Service\SomeTest\Transformer;

use App\Service\SomeTest\Transformer\TransformerInterface;

final class UppercaseTransformer implements TransformerInterface
{
    public function transform(string $value): string
    {
        return strtoupper($value);
    }
}