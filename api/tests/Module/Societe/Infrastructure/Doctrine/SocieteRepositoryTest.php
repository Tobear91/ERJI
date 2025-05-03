<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\DoctrineGenericRepository;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;
use PHPUnit\Framework\TestCase;
use App\Module\User\Infrastructure\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;

final class SocieteRepositoryTest extends TestCase
{
    public function testSave(): void
    {
        $entity = new SocieteRecord();
        $entity->setName('Test Company');
        $entity->setAddress('123 Test St');
        $entity->setPostalCode('12345');
        $entity->setCity('Test City');

        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($entity);

        $entityManager->expects($this->once())
            ->method('flush');

        $repository = new class($entityManager) extends DoctrineGenericRepository {
            public function __construct(EntityManagerInterface $em)
            {
                parent::__construct($em, SocieteRecord::class);
            }
        };

        $repository->save($entity);
    }

    public function testFindAll(): void
    {
        $societeRecord = new SocieteRecord();
        $societeRecord->setName('Test Company');
        $societeRecord->setAddress('123 Test St');
        $societeRecord->setPostalCode('12345');
        $societeRecord->setCity('Test City');

        $entityRepository = $this->createMock(EntityRepository::class);
        $entityRepository->method('findAll')->willReturn([$societeRecord]);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getRepository')->willReturn($entityRepository);

        $repository = new SocieteRepository($entityManager);
        $societes = $repository->findAll();

        $this->assertCount(1, $societes);
        $this->assertSame('Test Company', $societes[0]->getName());
    }
}
