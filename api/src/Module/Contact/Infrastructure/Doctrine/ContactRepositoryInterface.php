<?php

namespace App\Module\Contact\Infrastructure\Doctrine;

use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;

interface ContactRepositoryInterface
{
    public function save(ContactRecord $contact): void;
}
