<?php

namespace LootsIt\LaravelSns;

use Illuminate\Support\Facades\Cache;

class AwsCertClient
{
    private static int $secondsInDay = 86400;

    public function __construct(
        private readonly string $cacheStore,
        private readonly string $cachePrefix,
    ) {}


    public function __invoke(string $certUrl): string | false
    {
        $cache = Cache::store($this->cacheStore);
        $cacheKey = "$this->cachePrefix$certUrl";

        $result = $cache->get($cacheKey);
        if (is_null($result)) {
            $result = file_get_contents($certUrl);
            $cache->put($cacheKey, $result, 10 * self::$secondsInDay);
        }

        return $result;
    }
}