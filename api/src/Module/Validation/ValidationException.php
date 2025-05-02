<?php

namespace App\Module\Validation;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends RuntimeException
{
    private array $errors = [];

    /**
     * Permet de formater les erreurs de validation d'une entité Doctrine@
     * @param ConstraintViolationListInterface $violations
     * @param string $message
     */
    public function __construct(
        ConstraintViolationListInterface $violations,
        string $message = 'Validation failed'
    ) {
        parent::__construct($message);

        foreach ($violations as $violation) {
            $path = trim($violation->getPropertyPath(), '[]');
            $this->errors[$path] = $violation->getMessage();
        }
    }

    /**
     * Retourne les erreurs de validation
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
