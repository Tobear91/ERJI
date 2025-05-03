<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Module\User\Domain\Entity\User;

final class UserTest extends TestCase
{
    public function testUserInstance(): void
    {
        $user = new User(
            firstname: 'John',
            lastname: 'Doe',
            email: 'john.doe@example.com'
        );

        $this->assertSame('John', $user->firstname);
        $this->assertSame('Doe', $user->lastname);
        $this->assertSame('john.doe@example.com', $user->email);
    }
}
