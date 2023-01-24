<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function useProxy(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_USE_PROXY,
    );
}
