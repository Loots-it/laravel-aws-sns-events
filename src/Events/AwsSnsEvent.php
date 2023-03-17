<?php

namespace LootsIt\LaravelSns\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use LootsIt\LaravelSns\AwsSnsMessage;

abstract class AwsSnsEvent
{
    use Dispatchable, InteractsWithSockets;

    protected function __construct(protected readonly AwsSnsMessage $snsMessage) {}
}