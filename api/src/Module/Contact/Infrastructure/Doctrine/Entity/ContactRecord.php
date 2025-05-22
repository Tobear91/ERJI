<?php

namespace App\Module\Contact\Infrastructure\Doctrine\Entity;

use App\Module\ContactFunction\Infrastructure\Doctrine\Entity\ContactFunctionRecord;
use App\Module\Intervenant\Infrastructure\Doctrine\Entity\IntervenantRecord;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'contact')]
class ContactRecord
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $firstname;

    #[ORM\Column(type: 'string', length: 32)]
    private string $lastname;

    #[ORM\Column(type: 'string', length: 128, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $created;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updated;

    #[ORM\ManyToOne(targetEntity: SocieteRecord::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private SocieteRecord $societe;

    #[ORM\ManyToOne(targetEntity: ContactFunctionRecord::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ContactFunctionRecord $contact_function;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: IntervenantRecord::class)]
    private Collection $intervenants;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->created = new DateTimeImmutable();
        $this->updated = new DateTimeImmutable();
        $this->intervenants = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getUpdated(): DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(DateTimeImmutable $updated): void
    {
        $this->updated = $updated;
    }

    public function getSociete(): SocieteRecord
    {
        return $this->societe;
    }

    public function setSociete(SocieteRecord $societe): void
    {
        $this->societe = $societe;
    }

    public function getContactFunction(): ContactFunctionRecord
    {
        return $this->contact_function;
    }

    public function setContactFunction(ContactFunctionRecord $contact_function): void
    {
        $this->contact_function = $contact_function;
    }

    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }
}
