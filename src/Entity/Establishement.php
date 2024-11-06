<?php

namespace App\Entity;

use App\Repository\EstablishementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: EstablishementRepository::class)]
class Establishement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["establishement", "staffs"])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(["establishement", "staffs", "promotions"])]
    private ?string $city = null;

    #[ORM\Column(length: 5)]
    #[Groups(["establishement", "staffs"])]
    private ?string $postal_code = null;

    #[ORM\Column(length: 255)]
    #[Groups(["establishement", "staffs"])]
    private ?string $email = null;

    #[ORM\OneToMany(targetEntity: Staff::class, mappedBy: 'establishement')]
    #[Groups(["establishement"])]
    private Collection $staff;

    #[ORM\OneToMany(targetEntity: Promotion::class, mappedBy: 'establishement', orphanRemoval: true)]
    #[Groups(["establishement"])]
    #[MaxDepth(1)]
    private Collection $promotions;

    public function __construct()
    {
        $this->staff = new ArrayCollection();
        $this->promotions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

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

    /**
     * @return Collection<int, Staff>
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): static
    {
        if (!$this->staff->contains($staff)) {
            $this->staff->add($staff);
            $staff->setEstablishement($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): static
    {
        if ($this->staff->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getEstablishement() === $this) {
                $staff->setEstablishement(null);
            }
        }

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
            $promotion->setEstablishement($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): static
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getEstablishement() === $this) {
                $promotion->setEstablishement(null);
            }
        }

        return $this;
    }
}
