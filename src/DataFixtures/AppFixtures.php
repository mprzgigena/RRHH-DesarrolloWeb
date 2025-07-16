<?php

namespace App\DataFixtures;

use App\Entity\Departamento;
use App\Entity\Director;
use App\Entity\Empleado;
use App\Entity\HistorialPuesto;
use App\Entity\Pais;
use App\Entity\Pelicula;
use App\Entity\Provincia;
use App\Entity\Puesto;
use App\Entity\Ubicacion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $faker = Factory::create('es_ES'); 

      
        $director1 = new Director();
        $director1->setNombreDirector('Steven Spielberg');
        $manager->persist($director1);

        $director2 = new Director();
        $director2->setNombreDirector('Quentin Tarantino');
        $manager->persist($director2);

        
        $pelicula1 = new Pelicula();
       
        $pelicula1->setPelicula('Jurassic Park'); 
        $pelicula1->setAñoEstreno(1993);
        $pelicula1->setDirector($director1);
        $manager->persist($pelicula1);

        $pelicula2 = new Pelicula();
       
        $pelicula2->setPelicula('Pulp Fiction');
        $pelicula2->setAñoEstreno(1994);
        $pelicula2->setDirector($director2);
        $manager->persist($pelicula2);

        
        $pais1 = new Pais();
        $pais1->setNombre('Argentina');
        $manager->persist($pais1);
        $this->addReference('pais_argentina', $pais1); 

        $pais2 = new Pais();
        $pais2->setNombre('España');
        $manager->persist($pais2);
        $this->addReference('pais_espana', $pais2); 

        
        $provincia1 = new Provincia();
        $provincia1->setNombre('Buenos Aires');
        $provincia1->setPais($pais1);
        $provincia1->setPoblacion($faker->numberBetween(3000000, 17000000));
        $provincia1->setSuperficie($faker->randomFloat(2, 30000, 307000));
        $manager->persist($provincia1);
        $this->addReference('provincia_buenos_aires', $provincia1); 

        $provincia2 = new Provincia();
        $provincia2->setNombre('Córdoba');
        $provincia2->setPais($pais1);
        $provincia2->setPoblacion($faker->numberBetween(1000000, 4000000)); 
        $provincia2->setSuperficie($faker->randomFloat(2, 50000, 166000)); 
        $manager->persist($provincia2);
        $this->addReference('provincia_cordoba', $provincia2);

        $provincia3 = new Provincia();
        $provincia3->setNombre('Madrid');
        $provincia3->setPais($pais2);
        $provincia3->setPoblacion($faker->numberBetween(3000000, 7000000)); 
        $provincia3->setSuperficie($faker->randomFloat(2, 5000, 10000)); 
        $manager->persist($provincia3);
        $this->addReference('provincia_madrid', $provincia3);

      
        $puesto1 = new Puesto();
        $puesto1->setNombre('Gerente');
        $puesto1->setSalarioMinimo(50000);
        $puesto1->setSalarioMaximo(100000);
        $manager->persist($puesto1);
        $this->addReference('puesto_gerente', $puesto1);

        $puesto2 = new Puesto();
        $puesto2->setNombre('Analista');
        $puesto2->setSalarioMinimo(30000);
        $puesto2->setSalarioMaximo(60000);
        $manager->persist($puesto2);
        $this->addReference('puesto_analista', $puesto2);

        $puesto3 = new Puesto();
        $puesto3->setNombre('Desarrollador');
        $puesto3->setSalarioMinimo(40000);
        $puesto3->setSalarioMaximo(80000);
        $manager->persist($puesto3);
        $this->addReference('puesto_desarrollador', $puesto3);

       
        $ubicacion1 = new Ubicacion();
        $ubicacion1->setCalle('Av. Corrientes 123');
        $ubicacion1->setCodigoPostal('C1043AAB');
        $ubicacion1->setCiudad('Buenos Aires');
        $ubicacion1->setProvincia($provincia1);
        $manager->persist($ubicacion1);
        $this->addReference('ubicacion_buenos_aires', $ubicacion1);

        $ubicacion2 = new Ubicacion();
        $ubicacion2->setCalle('C/ Gran Vía 45');
        $ubicacion2->setCodigoPostal('28013');
        $ubicacion2->setCiudad('Madrid');
        $ubicacion2->setProvincia($provincia3);
        $manager->persist($ubicacion2);
        $this->addReference('ubicacion_madrid', $ubicacion2);

      
        $empleado1 = new Empleado();
        $empleado1->setNombre('Juan');
        $empleado1->setApellido('Perez');
        $empleado1->setEmail('juan.perez@empresa.com');
        $empleado1->setTelefono(1123456789);
        $empleado1->setFechaIngreso(new \DateTime('2020-01-15'));
        $empleado1->setSalario(80000);
        $empleado1->setComision(0);
        $empleado1->setPuesto($puesto1);
        $manager->persist($empleado1);
        $this->addReference('empleado-juan', $empleado1);

        $empleado2 = new Empleado();
        $empleado2->setNombre('Maria');
        $empleado2->setApellido('Gomez');
        $empleado2->setEmail('maria.gomez@empresa.com');
        $empleado2->setTelefono(1198765432);
        $empleado2->setFechaIngreso(new \DateTime('2021-03-10'));
        $empleado2->setSalario(45000);
        $empleado2->setComision(0);
        $empleado2->setPuesto($puesto2);
        $manager->persist($empleado2);
        $this->addReference('empleado-maria', $empleado2);

        $empleado3 = new Empleado();
        $empleado3->setNombre('Carlos');
        $empleado3->setApellido('Lopez');
        $empleado3->setEmail('carlos.lopez@empresa.com');
        $empleado3->setTelefono(1155554444);
        $empleado3->setFechaIngreso(new \DateTime('2022-07-20'));
        $empleado3->setSalario(65000);
        $empleado3->setComision(0);
        $empleado3->setPuesto($puesto3);
        $manager->persist($empleado3);
        $this->addReference('empleado-carlos', $empleado3);

       
        $departamento1 = new Departamento();
        $departamento1->setNombre('Ventas');
        $departamento1->setUbicacion($ubicacion1);
        $departamento1->setJefe($empleado1);
        $manager->persist($departamento1);
        $this->addReference('departamento-ventas', $departamento1);

        $departamento2 = new Departamento();
        $departamento2->setNombre('IT');
        $departamento2->setUbicacion($ubicacion2);
        $departamento2->setJefe($empleado3);
        $manager->persist($departamento2);
        $this->addReference('departamento-it', $departamento2);

       
        $empleado1->setDepartamento($departamento1);
        $empleado2->setDepartamento($departamento1);
        $empleado2->setJefe($empleado1);
        $empleado3->setDepartamento($departamento2);
        $empleado3->setJefe($empleado1); 

        $historial1 = new HistorialPuesto();
        $historial1->setEmpleado($empleado2);
        $historial1->setPuesto($puesto2);
        $historial1->setDepartamento($departamento1);
        $historial1->setFechaInicio(new \DateTime('2021-03-10'));
        $historial1->setFechaFin(new \DateTime('2023-01-01'));
        $manager->persist($historial1);

     
        $puestos = [$puesto1, $puesto2, $puesto3];
        $ubicaciones = [$ubicacion1, $ubicacion2];
        $jefes = [$empleado1, $empleado3]; 

        
        for ($i = 0; $i < 10; $i++) {
            $departamento = new Departamento();
            $departamento->setNombre($faker->unique()->word() . ' Dept.');
            $departamento->setUbicacion($faker->randomElement($ubicaciones));
            
            $departamento->setJefe($faker->randomElement($jefes)); 
            $manager->persist($departamento);
            $this->addReference('departamento_faker_' . $i, $departamento);
        }
        $manager->flush();


        $fakerDepartamentos = [];

       
        for ($i = 0; $i < 10; $i++) {
            $departamento = new Departamento();
            $departamento->setNombre($faker->unique()->word() . ' Dept.');
            $departamento->setUbicacion($faker->randomElement($ubicaciones));
            $departamento->setJefe($faker->randomElement($jefes)); 
            $manager->persist($departamento);
            $fakerDepartamentos[] = $departamento; 
        }
        $manager->flush(); 
        $allDepartamentos = array_merge($fakerDepartamentos, [$departamento1, $departamento2]);
        
       
        for ($i = 0; $i < 20; $i++) {
            $empleado = new Empleado();
            $empleado->setNombre($faker->firstName());
            $empleado->setApellido($faker->lastName());
            $empleado->setEmail($faker->unique()->email());
          
            $empleado->setTelefono($faker->numberBetween(1000000000, 9999999999)); 
            
            $empleado->setFechaIngreso($faker->dateTimeBetween('-5 years', 'now')); 
          
            $empleado->setSalario($faker->numberBetween(25000, 90000)); 
            $empleado->setComision($faker->numberBetween(0, 5000)); 
            $empleado->setPuesto($faker->randomElement($puestos)); 
            $empleado->setDepartamento($faker->randomElement($allDepartamentos)); 
            $empleado->setJefe($faker->randomElement($jefes)); 

            $manager->persist($empleado);
        }

        $manager->flush();
    }
}