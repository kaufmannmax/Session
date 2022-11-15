<?php

declare(strict_types=1);

namespace Kaufmannmax\Entity\Session;

class Config
{
    public function __construct(
        public readonly string $sessionname='',
        public readonly bool $secure=true,
        public readonly bool $httponly=true,
        public readonly Samesite $samesite=Samesite::LAX
    ) {
    }
}
