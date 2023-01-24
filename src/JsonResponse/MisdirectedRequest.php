<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

function misdirectedRequest(mixed $data = null): JsonResponse
{
    return new JsonResponse(
        data: $data,
        status: Response::HTTP_MISDIRECTED_REQUEST
    );
}
