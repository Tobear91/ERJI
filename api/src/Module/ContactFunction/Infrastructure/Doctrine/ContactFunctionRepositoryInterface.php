<?php

namespace App\Module\ContactFunction\Infrastructure\Doctrine;

use App\Module\ContactFunction\Infrastructure\Doctrine\Entity\ContactFunctionRecord;

interface ContactFunctionRepositoryInterface
{
    public function save(ContactFunctionRecord $contactfunction): void;
    public function findOneById(string $id): ContactFunctionRecord;
}
