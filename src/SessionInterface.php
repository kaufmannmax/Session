<?php
declare(strict_types=1);

namespace Kaufmannmax\Session;

interface SessionInterface
{
    public function set(string $key, mixed $value): void;
    public function regenerate(): bool;
    public function has(string $key): bool;
    public function forget(string $key): void;
    public function get(string $key, mixed $default = null): mixed;
    public function start(): bool;
    public function save(): void;
    public function isActive(): bool;
    public function flash(string $key, array $messages): void;
    public function getFlash(string $key): array;
}
