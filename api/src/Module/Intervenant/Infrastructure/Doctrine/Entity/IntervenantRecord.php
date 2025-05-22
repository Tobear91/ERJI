<?php

namespace App\Module\Intervenant\Infrastructure\Doctrine\Entity;

use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'intervenant')]
class IntervenantRecord
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'boolean')]
    private bool $vic = false;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $created;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updated;

    #[ORM\ManyToOne(targetEntity: ContactRecord::class, inversedBy: 'intervenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ContactRecord $contact;

    #[ORM\ManyToOne(targetEntity: ChantierRecord::class, inversedBy: 'intervenants')]
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

    public function isVic(): bool
    {
        return $this->vic;
    }

    public function setVic(bool $vic): self
    {
        $this->vic = $vic;
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

    public function getContact(): ContactRecord
    {
        return $this->contact;
    }

    public function setContact(ContactRecord $contact): self
    {
        $this->contact = $contact;
        return $this;
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
