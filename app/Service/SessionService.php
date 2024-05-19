<?php

namespace App\Service;

class SessionService
{
    public function store($key, $value): void
    {
        session([$key => $value]);
    }

    public function get($key)
    {
        return session($key);
    }

    public function forget($key): void
    {
        session()->forget($key);
    }
}
