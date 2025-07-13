<?php


namespace App\DataFixtures;

use App\Entity\Director;
use App\Entity\Pelicula;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1.  Directores
        $director1 = new Director();
        $director1->setNombreDirector('Steven Spielberg');
        $manager->persist($director1);

        $director2 = new Director();
        $director2->setNombreDirector('Quentin Tarantino');
        $manager->persist($director2);

        $director3 = new Director();
        $director3->setNombreDirector('Christopher Nolan');
        $manager->persist($director3);

        // 2.  Películas 

        // Películas de Spielberg
        $pelicula1 = new Pelicula();
        $pelicula1->setPelicula('Jurassic Park');
        $pelicula1->setAñoEstreno(1993);
        $pelicula1->setDirector($director1);
        $manager->persist($pelicula1);

        $pelicula2 = new Pelicula();
        $pelicula2->setPelicula('E.T. the Extra-Terrestrial');
        $pelicula2->setAñoEstreno(1982);
        $pelicula2->setDirector($director1);
        $manager->persist($pelicula2);

        // Películas de Tarantino
        $pelicula3 = new Pelicula();
        $pelicula3->setPelicula('Pulp Fiction');
        $pelicula3->setAñoEstreno(1994);
        $pelicula3->setDirector($director2);
        $manager->persist($pelicula3);

        $pelicula4 = new Pelicula();
        $pelicula4->setPelicula('Kill Bill: Vol. 1');
        $pelicula4->setAñoEstreno(2003);
        $pelicula4->setDirector($director2);
        $manager->persist($pelicula4);

        // Película de Nolan
        $pelicula5 = new Pelicula();
        $pelicula5->setPelicula('Inception');
        $pelicula5->setAñoEstreno(2010);
        $pelicula5->setDirector($director3);
        $manager->persist($pelicula5);

        $manager->flush();
    }
}