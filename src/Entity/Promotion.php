<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["promotions", "students", "staffs"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["promotions", "students", "staffs"])]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    #[Groups(["promotions"])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[ORM\JoinColumn(nullable: false)]
    // #[Groups(["promotions"])]
    private ?Establishement $establishement = null;

    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'promotion')]
    // #[Groups(["promotions"])]
    // #[MaxDepth(1)]
    private Collection $students;
    
    #[ORM\ManyToMany(targetEntity: Staff::class, inversedBy: 'promotions')]
    // #[Groups(["promotions"])]
    // #[MaxDepth(1)]
    private Collection $staff;

    public function __construct()
    {
        $this->staff = new ArrayCollection();
        $this->students = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
        }

        return $this;
    }

    public function removeStaff(Staff $staff): static
    {
        $this->staff->removeElement($staff);

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setPromotion($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getPromotion() === $this) {
                $student->setPromotion(null);
            }
        }

        return $this;
    }
}
