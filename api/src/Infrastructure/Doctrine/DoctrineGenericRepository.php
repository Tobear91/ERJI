<?php

namespace App\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineGenericRepository implements DoctrineGenericRepositoryInterface
{
    private EntityRepository $repository;

    /**
     * Il instancie le repository de l'entité
     * @param EntityManagerInterface $entityManager
     * @param string $entityClass
     */
    public function __construct(private EntityManagerInterface $entityManager, private string $entityClass)
    {
        $this->repository = $this->entityManager->getRepository($this->entityClass);
    }

    /**
     * Permet de persister une entité
     * @param object $entity
     * @return void
     */
    public function save(object $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * Permet de récupérer toutes les entités
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * Récupère une entité par son identifiant
     * @param string $id
     * @return object|null
     */
    public function findOneById(string $id): ?object
    {
        $repository = $this->entityManager->getRepository($this->entityClass);
        return $repository->find($id);
    }
}
