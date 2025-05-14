<?php

namespace App\Module\ContactFunction\Infrastructure\Doctrine;

use App\Module\ContactFunction\Infrastructure\Doctrine\Entity\ContactFunctionRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactFunctionRepository extends DoctrineGenericRepository implements ContactFunctionRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, ContactFunctionRecord::class);
    }

    public function findOneById(string $id): ContactFunctionRecord
    {
        $record = parent::findOneById($id);
        if (!$record instanceof ContactFunctionRecord) throw new \RuntimeException('Unexpected type');
        return $record;
    }
}
