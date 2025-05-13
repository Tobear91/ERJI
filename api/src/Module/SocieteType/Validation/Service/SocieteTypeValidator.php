<?php

namespace App\Module\SocieteType\Validation\Service;

use App\Module\Validation\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class SocieteTypeValidator
{
    public static function validate(array $data): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'label' => [
                new Assert\NotBlank(message: "Label should not be blank"),
                new Assert\Type(['type' => 'string', 'message' => "Label should be a string"]),
            ],
        ]);

        $violations = $validator->validate($data, $constraints);

        if (count($violations) > 0)
            throw new ValidationException($violations);

        return true;
    }
}
