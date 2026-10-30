<?php

namespace App\Observers;

use App\Models\Application;
use Illuminate\Support\Facades\Cache;

class ApplicationObserver
{
    private const string CACHE_VERSION_KEY = 'applications:version';

    public function saved(Application $application): void
    {
        $this->flushCache();
    }

    public function deleted(Application $application): void
    {
        $this->flushCache();
    }

    private function flushCache(): void
    {
        Cache::forever(
            self::CACHE_VERSION_KEY,
            (int) Cache::get(self::CACHE_VERSION_KEY, 1) + 1
        );
    }
}
