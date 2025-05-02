<?php

namespace App\Module\Societe\Infrastructure\Doctrine;

use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class SocieteRepository extends DoctrineGenericRepository implements SocieteRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, SocieteRecord::class);
    }
}
