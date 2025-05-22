<?php

namespace App\Module\Intervenant\Infrastructure\Doctrine;

use App\Module\Intervenant\Infrastructure\Doctrine\Entity\IntervenantRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class IntervenantRepository extends DoctrineGenericRepository implements IntervenantRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, IntervenantRecord::class);
    }
}
