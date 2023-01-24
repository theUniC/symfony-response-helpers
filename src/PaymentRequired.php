<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Response;

function paymentRequired(string $content = ""): Response
{
    return new Response(
        content: $content,
        status: Response::HTTP_PAYMENT_REQUIRED,
    );
}
