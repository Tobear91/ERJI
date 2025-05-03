<?php

declare(strict_types=1);

use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;
use App\Module\User\Application\Service\UserMapper;
use App\Module\User\Application\DTO\UserDTO;
use App\Module\User\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserMapperTest extends TestCase
{
    public function testToDomain(): void
    {
        $record = new UserRecord();
        $record->setFirstname('Jane');
        $record->setLastname('Doe');
        $record->setEmail('jane.doe@example.com');

        $user = UserMapper::toDomain($record);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('Jane', $user->firstname);
        $this->assertSame('Doe', $user->lastname);
        $this->assertSame('jane.doe@example.com', $user->email);
    }

    public function testToRecord(): void
    {
        $user = new User(
            firstname: 'John',
            lastname: 'Smith',
            email: 'john.smith@example.com'
        );

        $record = UserMapper::toRecord($user);

        $this->assertInstanceOf(UserRecord::class, $record);
        $this->assertSame('John', $record->getFirstname());
        $this->assertSame('Smith', $record->getLastname());
        $this->assertSame('john.smith@example.com', $record->getEmail());
    }

    public function testToDTO(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';
        $user = new User(
            id: $uuid,
            firstname: 'Alice',
            lastname: 'Wonderland',
            email: 'alice.wonderland@example.com',
            created: new DateTimeImmutable('2025-05-01 10:00:00'),
            updated: new DateTimeImmutable('2025-05-02 15:00:00')
        );

        $dto = UserMapper::toDTO($user);

        $this->assertInstanceOf(UserDTO::class, $dto);
        $this->assertSame($uuid, $dto->id);
        $this->assertSame('Alice', $dto->firstname);
        $this->assertSame('Wonderland', $dto->lastname);
        $this->assertSame('alice.wonderland@example.com', $dto->email);
        $this->assertSame('2025-05-01 10:00:00', $dto->created);
        $this->assertSame('2025-05-02 15:00:00', $dto->updated);
    }
}
