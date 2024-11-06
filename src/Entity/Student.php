<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StudentRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource()]
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["students", "promotions"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["students", "promotions"])]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(["students", "promotions"])]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    #[Groups(["students", "promotions"])]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    // #[Groups(["students"])]
    // #[MaxDepth(1)]
    private ?Promotion $promotion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): static
    {
        $this->promotion = $promotion;

        return $this;
    }
}
