<?php

namespace App\Module\Intervenant\Validation\Service;

use App\Module\Validation\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class IntervenantValidator
{
    public static function validate(array $data): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'vic' => [
                new Assert\Type(['type' => 'boolean', 'message' => "VIC should be a boolean"]),
            ],
            'contact_id' => [
                new Assert\Uuid(message: "Contact ID should be a valid UUID"),
            ],
            'chantier_id' => [
                new Assert\Uuid(message: "Chantier ID should be a valid UUID"),
            ],
        ]);

        $violations = $validator->validate($data, $constraints);

        if (count($violations) > 0)
            throw new ValidationException($violations);

        return true;
    }
}
