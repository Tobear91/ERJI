<?php

namespace App\Module\Chantier\Infrastructure\Doctrine;

use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class ChantierRepository extends DoctrineGenericRepository implements ChantierRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, ChantierRecord::class);
    }
}
