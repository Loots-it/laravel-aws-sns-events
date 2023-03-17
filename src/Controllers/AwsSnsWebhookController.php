<?php

namespace LootsIt\LaravelSns\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use LootsIt\LaravelSns\AwsSnsMessage;
use LootsIt\LaravelSns\Enums\AwsSnsRequestType;

class AwsSnsWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $snsMessage = AwsSnsMessage::fromInput($request->input());
        $snsEventClass = config('app.sns-topics')[$snsMessage->topicArn] ?? null;
        abort_unless($snsEventClass, 404);

        return match ($snsMessage->type)
        {
            AwsSnsRequestType::SUBSCRIBE => $this->handleSubscribeMessage($snsMessage),
            AwsSnsRequestType::NOTIFICATION => $this->handleNotificationMessage($snsMessage, $snsEventClass),
        };
    }

    private function handleSubscribeMessage(AwsSnsMessage $message): Response
    {
        Http::get($message->subscribeUrl);
        return $this->returnOk();
    }

    private function handleNotificationMessage(AwsSnsMessage $message, string $snsEventClass): Response
    {
        $snsEventClass::dispatch($message);
        return $this->returnOk();
    }

    private function returnOk(): Response
    {
        return response('OK', 200);
    }
}