<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      for($i= 1; $i <= 5; $i++ )
      {
          $client = new Client();
          $client->setNom("nom du client n°$i")
                ->setPrenom("prenom du client n°$i")
                ->setNum("num du client n°$i")
                ->setDate("date du client n°$i")
                ->setEmail("email du client n°$i")
                ->setPassword("pass du client n°$i")
                ->setSexe(" n°$i");

        $manager->persist($client);

      }
        $manager->flush();
    }
}
