<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

function badGateway(mixed $data = null): JsonResponse
{
    return new JsonResponse(
        data: $data,
        status: Response::HTTP_BAD_GATEWAY
    );
}
