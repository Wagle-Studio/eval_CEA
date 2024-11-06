<?php

namespace App\DataFixtures;

use App\Entity\Staff;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StaffFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $positions = [
            "Chargé(e) de projets",
            "Chargé(e) de développement",
            "Directeur(rice)",
            "Service comptabilité",
            "Service communication",
        ];

        for ($i = 0; $i < 50; $i++) {
            $staff = new Staff();
            $staff->setName($this->faker->lastName());
            $staff->setSurname($this->faker->firstName());
            $staff->setEmail($this->faker->email());
            $staff->setEstablishement($this->getReference("establishement_" . $this->faker->numberBetween(0, 3)));
            $staff->setPosition($positions[$this->faker->numberBetween(0, count($positions) - 1)]);

            $manager->persist($staff);
            $this->setReference("staff_" . $i, $staff);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EstablishementFixtures::class
        ];
    }
}
