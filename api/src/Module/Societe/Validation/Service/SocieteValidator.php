<?php

namespace App\Module\Societe\Validation\Service;

use App\Module\Validation\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class SocieteValidator
{
    public static function validate(array $data): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'name' => [
                new Assert\NotBlank(message: "Firstname should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Firstname should be a string"]),
            ],
            'address' => [
                new Assert\NotBlank(message: "Lastname should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Lastname should be a string"]),
            ],
            'postal_code' => [
                new Assert\NotBlank(message: "Postal code should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Postal code should be a string"]),
            ],
            'city' => [
                new Assert\NotBlank(message: "City should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "City should be a string"]),
            ],
            'societe_type_id' => [
                new Assert\Uuid(message: "Societe type ID should be a valid UUID"),
            ],
        ]);

        $violations = $validator->validate($data, $constraints);

        if (count($violations) > 0)
            throw new ValidationException($violations);

        return true;
    }
}
