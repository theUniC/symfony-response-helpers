<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function seeOther(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_SEE_OTHER,
    );
}
