<?php

declare(strict_types=1);

namespace Kaufmannmax\Entity\Session;

enum Samesite: string
{
    case LAX='lax';
    case NONE='none';
    case STRICT='strict';
}
