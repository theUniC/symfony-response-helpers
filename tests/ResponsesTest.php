<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Psl\Fun;
use Functional as f;
use function Symfony\Component\String\u;

final class ResponsesTest extends TestCase
{
    /**
     * @test
     * @dataProvider functions
     */
    public function responsesAreInstantiatedSuccessfully(string $functionName, int $expectedStatusCode): void
    {
        $response = "\\Symfony\\Component\\HttpFoundation\\Response\\$functionName"("test");

        self::assertInstanceOf(Response::class, $response);
        self::assertSame($expectedStatusCode, $response->getStatusCode());
        self::assertSame("test", $response->getContent());
    }

    /**
     * @test
     * @dataProvider functions
     */
    public function jsonResponsesAreInstantiatedSuccessfully(string $functionName, int $expectedStatusCode): void
    {
        $data = ['data' => 'test'];
        $response = "\\Symfony\\Component\\HttpFoundation\\JsonResponse\\$functionName"($data);

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertSame($expectedStatusCode, $response->getStatusCode());
        self::assertSame(json_encode($data), $response->getContent());
    }

    public static function functions(): iterable
    {
        $reflectedClass = new ReflectionClass(Response::class);

        $pipe = Fun\pipe(
            strtolower(...),
            f\partial_left(str_replace(...), "http_", ""),
            static fn(string $s): string => u($s)->camel()->toString(),
            static function (string $s): string {
                $reservedWords = [
                    'continue' => 'continueResponse'
                ];

                foreach ($reservedWords as $reservedWord => $substitution) {
                    if ($reservedWord === $s) {
                        return $substitution;
                    }
                }

                return $s;
            }
        );

        foreach ($reflectedClass->getConstants() as $constantName => $expectedStatusCode) {
            if (!is_int($expectedStatusCode) || $expectedStatusCode < 100 || $expectedStatusCode > 511) {
                continue;
            }

            $functionName = $pipe($constantName);
            yield [$functionName, $expectedStatusCode];
        }
    }
}