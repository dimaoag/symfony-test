<?php

declare(strict_types=1);

namespace App\Util;

final class UppercaseTransformer implements TransformerInterface
{
    public function transform(string $value): string
    {
        return strtoupper($value);
    }
}