<?php

namespace App\Module\User\Validation\Service;

use App\Module\Validation\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class UserValidator
{
    public static function validate(array $data): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'firstname' => [
                new Assert\NotBlank(message: "Firstname should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Firstname should be a string"]),
            ],
            'lastname' => [
                new Assert\NotBlank(message: "Lastname should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Lastname should be a string"]),
            ],
            'email' => [
                new Assert\NotBlank(message: "Email should not be blank"),
                new Assert\Email(message: "{{ value }} is not a valid email address"),
            ],
        ]);

        $violations = $validator->validate($data, $constraints);

        if (count($violations) > 0)
            throw new ValidationException($violations);

        return true;
    }
}
