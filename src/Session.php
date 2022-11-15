<?php

declare(strict_types=1);

namespace Kaufmannmax\Session;

use Kaufmannmax\Entity\Session\Config;
use Kaufmannmax\Session\Exception\SessionException;

class Session implements SessionInterface
{
    public function __construct(
        public string          $token = '',
        public bool            $startsession = false,
        public readonly Config $config = new Config()
    ) {
        if ($this->token == '') {
            $this->token = $_SESSION['token'] ?? '';
        }

        if ($this->startsession) {
            $this->start();
        }
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function regenerate(): bool
    {
        return session_regenerate_id();
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

    public function start(): bool
    {
        if ($this->isActive()) {
            throw new SessionException('Session has already been started');
        }

        if (headers_sent($fileName, $line)) {
            throw new SessionException('Headers already sent by ' . $fileName . ':' . $line);
        }

        session_set_cookie_params(
            [
                'secure' => $this->config->secure,
                'httponly' => $this->config->httponly,
                'samesite' => $this->config->samesite->value
            ]
        );

        if (!empty($this->config->sessionname)) {
            session_name($this->config->sessionname);
        }

        if (!session_start()) {
            throw new SessionException('Unable to start session');
        }
        return true;
    }

    public function save(): void
    {
        session_write_close();
    }

    public function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public function flash(string $key, array $messages): void
    {
        $_SESSION[$this->config->flashname][$key] = $messages;
    }

    public function getFlash(string $key): array
    {
        $messages = $_SESSION[$this->config->flashname][$key] ?? [];

        unset($_SESSION[$this->config->flashname][$key]);

        return $messages;
    }
}
