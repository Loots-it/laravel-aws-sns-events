<?php

namespace LootsIt\LaravelSns\Middleware;

use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidateAwsSnsRequest
{

    public function __construct(private readonly MessageValidator $messageValidator){}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $message = Message::fromRawPostData();

        if ($this->messageValidator->isValid($message))
        {
            $request->merge($message->toArray());
            return $next($request);
        }
        else
        {
            Log::warning("AWS SNS request validation failed.");
            abort(404);
        }
    }
}
