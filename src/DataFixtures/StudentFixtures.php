<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 200; $i++) {
            $student = new Student();
            $student->setName($this->faker->lastName());
            $student->setSurname($this->faker->firstName());
            $student->setEmail($this->faker->email());
            $student->setPromotion($this->getReference("promotion_" . $this->faker->numberBetween(0, 19)));
            $manager->persist($student);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PromotionFixtures::class
        ];
    }
}
