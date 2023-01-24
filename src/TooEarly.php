<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function tooEarly(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_TOO_EARLY,
    );
}
