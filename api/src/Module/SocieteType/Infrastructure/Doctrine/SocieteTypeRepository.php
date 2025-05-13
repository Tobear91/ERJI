<?php

namespace App\Module\SocieteType\Infrastructure\Doctrine;

use App\Module\SocieteType\Infrastructure\Doctrine\Entity\SocieteTypeRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class SocieteTypeRepository extends DoctrineGenericRepository implements SocieteTypeRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, SocieteTypeRecord::class);
    }

    public function findOneById(string $id): SocieteTypeRecord
    {
        $record = parent::findOneById($id);
        if (!$record instanceof SocieteTypeRecord) throw new \RuntimeException('Unexpected type');
        return $record;
    }
}
