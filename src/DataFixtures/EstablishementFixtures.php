<?php

namespace App\DataFixtures;

use App\Entity\Establishement;
use Doctrine\Persistence\ObjectManager;

class EstablishementFixtures extends AbstractFixtures
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 4; $i++) {
            $establishement = new Establishement();
            $establishement->setCity($this->faker->city());
            $establishement->setPostalCode($this->faker->postcode());
            $establishement->setEmail($this->faker->email());

            $manager->persist($establishement);
            $this->setReference("establishement_" . $i, $establishement);
        }

        $manager->flush();
    }
}
