<?php

namespace App\Module\Contact\Infrastructure\Doctrine;

use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactRepository extends DoctrineGenericRepository implements ContactRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, ContactRecord::class);
    }
}
