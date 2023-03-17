<?php

namespace LootsIt\LaravelSns;

use LootsIt\LaravelSns\Enums\AwsSnsRequestType;

class AwsSnsMessage
{
    private function __construct(
        public readonly string $id,
        public readonly AwsSnsRequestType $type,
        public readonly string $topicArn,
        public readonly string $message,
        public readonly ?string $subscribeUrl,
    ) {}

    public static function fromInput(array $input): AwsSnsMessage
    {
        return new AwsSnsMessage(
            $input['MessageId'],
            AwsSnsRequestType::from($input['Type']),
            $input['TopicArn'],
            $input['Message'],
            $input['SubscribeURL'] ?? null,
        );
    }
}