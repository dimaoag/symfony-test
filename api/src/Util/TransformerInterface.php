<?php

declare(strict_types=1);

namespace App\Util;

interface TransformerInterface
{
    public function transform(string $value): string;

}