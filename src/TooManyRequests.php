<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function tooManyRequests(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_TOO_MANY_REQUESTS,
    );
}
