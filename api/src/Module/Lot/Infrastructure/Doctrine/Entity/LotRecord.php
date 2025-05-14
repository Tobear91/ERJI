<?php

namespace App\Module\Lot\Infrastructure\Doctrine\Entity;

use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'lot')]
class LotRecord
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

    #[ORM\ManyToOne(targetEntity: ChantierRecord::class, inversedBy: 'chantiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ChantierRecord $chantier;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->created = new DateTimeImmutable();
        $this->updated = new DateTimeImmutable();
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

    public function getChantier(): ChantierRecord
    {
        return $this->chantier;
    }

    public function setChantier(ChantierRecord $chantier): self
    {
        $this->chantier = $chantier;
        return $this;
    }
}
