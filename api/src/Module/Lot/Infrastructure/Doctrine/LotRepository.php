<?php

namespace App\Module\Lot\Infrastructure\Doctrine;

use App\Module\Lot\Infrastructure\Doctrine\Entity\LotRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class LotRepository extends DoctrineGenericRepository implements LotRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, LotRecord::class);
    }

    public function findOneById(string $id): LotRecord
    {
        $record = parent::findOneById($id);
        if (!$record instanceof LotRecord) throw new \RuntimeException('Unexpected type');
        return $record;
    }
}
