<?php

namespace App\Module\Contact\Validation\Service;

use App\Module\Validation\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ContactValidator
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
            'email' => new Assert\Optional([
                new Assert\Email(message: "{{ value }} is not a valid email address"),
            ]),
            'phone' => new Assert\Optional([
                new Assert\Type(['type' => 'string', 'message' => "Phone should be a string"]),
            ]),
            'societe_id' => [
                new Assert\Uuid(message: "Societe ID should be a valid UUID"),
            ],
            'contact_function_id' => [
                new Assert\Uuid(message: "Contact fonction ID should be a valid UUID"),
            ],
        ]);

        $violations = $validator->validate($data, $constraints);

        if (count($violations) > 0)
            throw new ValidationException($violations);

        return true;
    }
}
