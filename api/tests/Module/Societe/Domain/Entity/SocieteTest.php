<?php

declare(strict_types=1);

use App\Module\Societe\Domain\Entity\Societe;
use PHPUnit\Framework\TestCase;


final class SocieteTest extends TestCase
{
    public function testSocieteInstance(): void
    {
        $societe = new Societe(
            name: 'societe',
            address: '123 Main St',
            postal_code: '12345',
            city: 'Anytown',
        );

        $this->assertInstanceOf(Societe::class, $societe);
        $this->assertSame('societe', $societe->name);
        $this->assertSame('123 Main St', $societe->address);
        $this->assertSame('12345', $societe->postal_code);
        $this->assertSame('Anytown', $societe->city);
    }
}
