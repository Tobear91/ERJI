<?php

namespace App\Module\Societe\Infrastructure\Doctrine\Entity;

use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use App\Module\SocieteType\Infrastructure\Doctrine\Entity\SocieteTypeRecord;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'societe')]
class SocieteRecord
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $name;

    #[ORM\Column(type: 'string', length: 64)]
    private string $address;

    #[ORM\Column(type: 'string', length: 16)]
    private string $postal_code;

    #[ORM\Column(type: 'string', length: 32)]
    private string $city;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $created;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updated;

    #[ORM\ManyToOne(targetEntity: SocieteTypeRecord::class, inversedBy: 'societes')]
    #[ORM\JoinColumn(nullable: false)]
    private SocieteTypeRecord $societe_type;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: ContactRecord::class)]
    private Collection $contacts;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->created = new DateTimeImmutable();
        $this->updated = new DateTimeImmutable();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
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

    public function getSocieteType(): SocieteTypeRecord
    {
        return $this->societe_type;
    }

    public function setSocieteType(SocieteTypeRecord $societe_type): self
    {
        $this->societe_type = $societe_type;
        return $this;
    }

    public function getContacts(): Collection
    {
        return $this->contacts;
    }
}
