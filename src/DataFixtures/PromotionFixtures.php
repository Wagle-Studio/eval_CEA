<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PromotionFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $status = [
            "PLANNED",
            "ONGOING",
            "ENDED",
            "CANCELLED",
        ];

        $promotionName = [
            "La Bastille",
            "Le Moucherotte",
            "Chamrousse",
            "La Dent de Crolles",
            "Le Néron",
            "Le Pic Saint-Michel",
            "La Grande Lance de Domène",
            "La Croix de Belledonne",
            "Le Taillefer",
            "Le Grand Colon",
            "Le Pic de l’Oeillette",
            "Le Charmant Som",
            "Le Grand Som",
            "Le Piquet de Nantes",
            "Le Mont Granier",
            "Le Mont Aiguille",
            "La Dent de l’Arclusaz",
            "La Tête de la Buffe",
            "Le Puy Gris",
            "Le Rocher de l’Homme"
        ];

        for ($i = 0; $i < 20; $i++) {
            $promotion = new Promotion();
            $promotion->setName($promotionName[$i]);
            $promotion->setStatus($status[$this->faker->numberBetween(0, count($status) - 1)]);
            $promotion->setEstablishement($this->getReference("establishement_" . $this->faker->numberBetween(0, 3)));

            for ($o = 0; $o < $this->faker->numberBetween(2, 4); $o++) {
                $promotion->addStaff($this->getReference("staff_" . $this->faker->numberBetween(0, 49)));
            }

            $manager->persist($promotion);
            $this->setReference("promotion_" . $i, $promotion);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EstablishementFixtures::class,
            StaffFixtures::class
        ];
    }
}
