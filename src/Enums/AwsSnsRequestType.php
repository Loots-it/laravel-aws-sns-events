<?php

namespace LootsIt\LaravelSns\Enums;

enum AwsSnsRequestType: string
{
    case NOTIFICATION = 'Notification';
    case SUBSCRIBE = 'SubscriptionConfirmation';
}
