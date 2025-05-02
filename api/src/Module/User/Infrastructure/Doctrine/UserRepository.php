<?php

namespace App\Module\User\Infrastructure\Doctrine;

use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;
use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends DoctrineGenericRepository implements UserRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, UserRecord::class);
    }
}
