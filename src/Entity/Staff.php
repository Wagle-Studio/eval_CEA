<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["staffs", "promotions"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["staffs", "promotions"])]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(["staffs"])]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    #[Groups(["staffs", "promotions"])]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(["staffs", "promotions"])]
    private ?string $position = null;

    #[ORM\ManyToOne(inversedBy: 'staff')]
    // #[Groups(["staffs", "promotions"])]
    private ?Establishement $establishement = null;

    #[ORM\ManyToMany(targetEntity: Promotion::class, mappedBy: 'staff')]
    // #[Groups(["staffs"])]
    // #[MaxDepth(1)]
    private Collection $promotions;

    public function __construct()
    {
        $this->promotions = new ArrayCollection();
    }

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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getEstablishement(): ?Establishement
    {
        return $this->establishement;
    }

    public function setEstablishement(?Establishement $establishement): static
    {
        $this->establishement = $establishement;

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): static
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions->add($promotion);
            $promotion->addStaff($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): static
    {
        if ($this->promotions->removeElement($promotion)) {
            $promotion->removeStaff($this);
        }

        return $this;
    }
}
