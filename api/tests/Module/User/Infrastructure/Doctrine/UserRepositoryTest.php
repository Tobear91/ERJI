<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use PHPUnit\Framework\TestCase;
use App\Module\User\Infrastructure\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;

final class UserRepositoryTest extends TestCase
{
    public function testSave(): void
    {
        $entity = new UserRecord();
        $entity->setFirstname('John')->setLastname('Doe')->setEmail('john@example.com');
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($entity);

        $entityManager->expects($this->once())
            ->method('flush');

        $repository = new class($entityManager) extends DoctrineGenericRepository {
            public function __construct(EntityManagerInterface $em)
            {
                parent::__construct($em, UserRecord::class);
            }
        };

        $repository->save($entity);
    }

    public function testFindAll(): void
    {
        $userRecord = new UserRecord();
        $userRecord->setFirstname('Alice');
        $userRecord->setLastname('Wonderland');
        $userRecord->setEmail('alice@example.com');

        $entityRepository = $this->createMock(EntityRepository::class);
        $entityRepository->method('findAll')->willReturn([$userRecord]);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getRepository')->willReturn($entityRepository);

        $repository = new UserRepository($entityManager);
        $users = $repository->findAll();

        $this->assertCount(1, $users);
        $this->assertSame('Alice', $users[0]->getFirstname());
    }
}
