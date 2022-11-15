<?php
declare(strict_types=1);

namespace Kaufmannmax\Session;

use Kaufmannmax\Session\Exception\SessionException;

interface SessionInterface
{
    /**
     * set a value to a key
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void;

    /**
     * Regenerate Sessionid
     * @return bool
     */
    public function regenerate(): bool;

    /**
     * check if a sessionkey exists
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * entirely remove a key from session
     * @param string $key
     * @return void
     */
    public function forget(string $key): void;

    /**
     * Get the value of a sessionkey
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Initiate the session
     * @return bool
     * @throws SessionException
     */
    public function start(): bool;

    /**
     * save out the session
     * @return void
     */
    public function save(): void;

    /**
     * Check if a session is already active
     * @return bool
     */
    public function isActive(): bool;
}
