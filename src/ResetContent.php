<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function resetContent(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_RESET_CONTENT,
    );
}
