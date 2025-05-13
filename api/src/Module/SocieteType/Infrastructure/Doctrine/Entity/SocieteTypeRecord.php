<?php

namespace App\Module\SocieteType\Infrastructure\Doctrine\Entity;

use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'societe_type')]
class SocieteTypeRecord
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $label;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $created;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updated;

    #[ORM\OneToMany(mappedBy: 'societe_type', targetEntity: SocieteRecord::class)]
    private Collection $societes;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->created = new DateTimeImmutable();
        $this->updated = new DateTimeImmutable();
        $this->societes = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }
    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(DateTimeImmutable $created): self
    {
        $this->created = $created;
        return $this;
    }

    public function getUpdated(): DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(DateTimeImmutable $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

    public function update(): void
    {
        $this->updated = new DateTimeImmutable();
    }

    public function getSocietes(): Collection
    {
        return $this->societes;
    }
}
