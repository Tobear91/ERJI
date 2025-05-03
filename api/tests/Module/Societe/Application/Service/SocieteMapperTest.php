<?php

declare(strict_types=1);

use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Domain\Entity\Societe;
use PHPUnit\Framework\TestCase;

final class SocieteMapperTest extends TestCase
{
    public function testToDomain(): void
    {
        $record = new SocieteRecord();
        $record->setName('Test Company');
        $record->setAddress('123 Test St');
        $record->setPostalCode('12345');
        $record->setCity('Test City');

        $societe = SocieteMapper::toDomain($record);

        $this->assertInstanceOf(Societe::class, $societe);
        $this->assertSame('Test Company', $societe->name);
        $this->assertSame('123 Test St', $societe->address);
        $this->assertSame('12345', $societe->postalCode);
        $this->assertSame('Test City', $societe->city);
    }

    public function testToRecord(): void
    {
        $societe = new Societe(
            name: 'Test Company',
            address: '123 Test St',
            postalCode: '12345',
            city: 'Test City'
        );

        $record = SocieteMapper::toRecord($societe);
        $this->assertInstanceOf(SocieteRecord::class, $record);
        $this->assertSame('Test Company', $record->getName());
        $this->assertSame('123 Test St', $record->getAddress());
        $this->assertSame('12345', $record->getPostalCode());
        $this->assertSame('Test City', $record->getCity());
    }

    public function testToDTO(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';

        $societe = new Societe(
            id: $uuid,
            name: 'Test Company',
            address: '123 Test St',
            postalCode: '12345',
            city: 'Test City',
            created: new DateTimeImmutable('2025-05-01 10:00:00'),
            updated: new DateTimeImmutable('2025-05-02 15:00:00')
        );

        $dto = SocieteMapper::toDTO($societe);

        $this->assertInstanceOf(SocieteDTO::class, $dto);
        $this->assertSame($uuid, $dto->id);
        $this->assertSame('Test Company', $dto->name);
        $this->assertSame('123 Test St', $dto->address);
        $this->assertSame('12345', $dto->postalCode);
        $this->assertSame('Test City', $dto->city);
        $this->assertSame('2025-05-01 10:00:00', $dto->created);
        $this->assertSame('2025-05-02 15:00:00', $dto->updated);
    }
}
