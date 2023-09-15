<?php

namespace App\DataFixtures;

use App\Entity\Visite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;


class VisiteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for($i=0; $i<100; $i++)
        {
            $visite = new Visite();
            $visite->setVille($faker->city)
            ->setPays($faker->country)
            ->setDatecreation($faker->dateTimeBetween('-10 years', 'now'))
            ->setTempsmin($faker->numberBetween(-20, 10))
            ->setTempsmax($faker->numberBetween(10, 40))
            ->setNote($faker->numberBetween(0, 20))
            ->setAvis($faker->sentences(4, true));

            $manager->persist($visite);
        }
        $manager->flush();
    }
}
