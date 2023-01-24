<?php

declare(strict_types=1);

namespace Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

function loopDetected(mixed $data = null): JsonResponse
{
    return new JsonResponse(
        data: $data,
        status: Response::HTTP_LOOP_DETECTED
    );
}
