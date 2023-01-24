# Symfony Response helpers

A small utility to ease the instantiation of Response objects

## Installation

    composer req theunic/symfony-response-helpers

## Usage

Use it in your Symfony controllers

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 

final class HomePageController extends AbstractController
{
    #[Route("/")]
    public function __invoke(): Response
    {
        return Response\ok("<h1>Hello World!</h1>");
    }
}
```

Or to generate json responses

```php
<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UsersRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Constraints as Assert;

final class UsersController extends AbstractController
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly ValidatorInterface $validator,
    ) {
    }
    
    #[Route("/api/users/{id}", methods: ["PUT"])]
    public function __invoke(int $id, Request $req): JsonResponse
    {
        $user = $this->usersRepository->find($id);
        
        if (!$user) {
            return JsonResponse\notFound(["error" => sprintf("User with id %d was not found", $id)]);
        }
        
        $data = json_decode($req->getContent(), associative: true, falgs: JSON_THROW_ON_ERROR);
        $constraint = new Assert\Collection([
            'username' => new Assert\NotEmpty(),
            'email' => [new Assert\NotEmpty(), new Assert\Email()]
        ]);
        
        $errors = $this->validator->validate($data, $contraint);
        
        if (count($errors) > 0) {
            return JsonResponse\badRequest(
                array_reduce(
                    $errors,
                    static function (array $errors, ContraintViolation $cv): array {
                        $errors[$cv->getPropertyPath()] = $error->getMessage();
                    },
                    []
                )
            );
        }
        
        return JsonResponse\ok([
            "id" => $id,
            "username" => $user->getUsername(),
            "email" => $user->getEmail()
        ]);
    }
}
```