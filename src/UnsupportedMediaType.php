<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function unsupportedMediaType(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_UNSUPPORTED_MEDIA_TYPE,
    );
}
