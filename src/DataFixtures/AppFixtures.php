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

      
        $paisArgentina = new Pais();
        $paisArgentina->setNombre('Argentina');
        $manager->persist($paisArgentina);
        
        
        $paisEspana = new Pais();
        $paisEspana->setNombre('España');
        $manager->persist($paisEspana);

        
        $directorSpielberg = new Director();
        $directorSpielberg->setNombreDirector('Steven Spielberg');
        $manager->persist($directorSpielberg);

        $directorTarantino = new Director();
        $directorTarantino->setNombreDirector('Quentin Tarantino');
        $manager->persist($directorTarantino);

       
        $manager->flush();

       
        $allPaises = [$paisArgentina, $paisEspana];
        $allDirectores = [$directorSpielberg, $directorTarantino];

       

       
        for ($i = 0; $i < 10; $i++) {
            $pais = new Pais();
            $pais->setNombre($faker->unique()->country());
            $manager->persist($pais);
            $allPaises[] = $pais; 
        }

        
        for ($i = 0; $i < 5; $i++) {
            $director = new Director();
            $director->setNombreDirector($faker->name());
            $manager->persist($director);
            $allDirectores[] = $director;

        
        $manager->flush();

       
        $puestoGerente = new Puesto();
        $puestoGerente->setNombre('Gerente');
        $puestoGerente->setSalarioMinimo(50000);
        $puestoGerente->setSalarioMaximo(100000);
        $manager->persist($puestoGerente);
        $this->addReference('puesto_gerente', $puestoGerente);

        $puestoAnalista = new Puesto();
        $puestoAnalista->setNombre('Analista');
        $puestoAnalista->setSalarioMinimo(30000);
        $puestoAnalista->setSalarioMaximo(60000);
        $manager->persist($puestoAnalista);
        $this->addReference('puesto_analista', $puestoAnalista);

        $puestoDesarrollador = new Puesto();
        $puestoDesarrollador->setNombre('Desarrollador');
        $puestoDesarrollador->setSalarioMinimo(40000);
        $puestoDesarrollador->setSalarioMaximo(80000);
        $manager->persist($puestoDesarrollador);
        $this->addReference('puesto_desarrollador', $puestoDesarrollador);

        $allPuestos = [$puestoGerente, $puestoAnalista, $puestoDesarrollador];
        $manager->flush(); 

        
        $provinciaBsAs = new Provincia();
        $provinciaBsAs->setNombre('Buenos Aires');
        $provinciaBsAs->setPais($paisArgentina);
        $provinciaBsAs->setPoblacion($faker->numberBetween(15000000, 17000000));
        $provinciaBsAs->setSuperficie($faker->randomFloat(2, 305000, 307000));
        $manager->persist($provinciaBsAs);

        
        $provinciaMadrid = new Provincia();
        $provinciaMadrid->setNombre('Madrid');
        $provinciaMadrid->setPais($paisEspana);
        $provinciaMadrid->setPoblacion($faker->numberBetween(6000000, 7000000));
        $provinciaMadrid->setSuperficie($faker->randomFloat(2, 7000, 8000));
        $manager->persist($provinciaMadrid);

        
        $manager->flush();

       
        $allProvincias = [$provinciaBsAs, $provinciaMadrid];

       
        for ($i = 0; $i < 30; $i++) {
            $provincia = new Provincia();
            $provincia->setNombre($faker->unique()->city() . ' Province');
            $provincia->setPais($faker->randomElement($allPaises));
            $provincia->setPoblacion($faker->numberBetween(50000, 5000000));
            $provincia->setSuperficie($faker->randomFloat(2, 1000, 150000));
            $manager->persist($provincia);
            $allProvincias[] = $provincia; 
        }

       
        $manager->flush();

       
        $ubicacionBsAs = new Ubicacion();
        $ubicacionBsAs->setCalle('Av. Corrientes 123');
        $ubicacionBsAs->setCodigoPostal('C1043AAB');
        $ubicacionBsAs->setCiudad('Buenos Aires');
        $ubicacionBsAs->setProvincia($provinciaBsAs);
        $manager->persist($ubicacionBsAs);
        
        $ubicacionMadrid = new Ubicacion();
        $ubicacionMadrid->setCalle('C/ Gran Vía 45');
        $ubicacionMadrid->setCodigoPostal('28013');
        $ubicacionMadrid->setCiudad('Madrid');
        $ubicacionMadrid->setProvincia($provinciaMadrid);
        $manager->persist($ubicacionMadrid);

        
        $allUbicaciones = [$ubicacionBsAs, $ubicacionMadrid];

       
        for ($i = 0; $i < 5; $i++) {
            $ubicacion = new Ubicacion();
            $ubicacion->setCalle($faker->streetAddress());
            $ubicacion->setCodigoPostal($faker->postcode());
            $ubicacion->setCiudad($faker->city());
            $ubicacion->setProvincia($faker->randomElement($allProvincias)); 
            $manager->persist($ubicacion);
            $allUbicaciones[] = $ubicacion;
        }
        $manager->flush(); 

        
        $peliculaJurassic = new Pelicula();
        $peliculaJurassic->setPelicula('Jurassic Park'); 
        $peliculaJurassic->setAñoEstreno(1993);
        $peliculaJurassic->setDirector($directorSpielberg);
        $manager->persist($peliculaJurassic);

        $peliculaPulp = new Pelicula();
        $peliculaPulp->setPelicula('Pulp Fiction');
        $peliculaPulp->setAñoEstreno(1994);
        $peliculaPulp->setDirector($directorTarantino);
        $manager->persist($peliculaPulp);
        
        
        $allPeliculas = [$peliculaJurassic, $peliculaPulp];

        
        for ($i = 0; $i < 20; $i++) {
            $pelicula = new Pelicula();
            $pelicula->setPelicula($faker->unique()->sentence(3)); 
            $pelicula->setAñoEstreno($faker->numberBetween(1980, 2024));
            $pelicula->setDirector($faker->randomElement($allDirectores)); 
            $manager->persist($pelicula);
            $allPeliculas[] = $pelicula;
        }
        $manager->flush(); 

        $empleadoJuan = new Empleado();
        $empleadoJuan->setNombre('Juan');
        $empleadoJuan->setApellido('Perez');
        $empleadoJuan->setEmail('juan.perez@empresa.com');
        $empleadoJuan->setTelefono(1123456789);
        $empleadoJuan->setFechaIngreso(new \DateTime('2020-01-15'));
        $empleadoJuan->setSalario(80000);
        $empleadoJuan->setComision(0);
        $empleadoJuan->setPuesto($puestoGerente);
        $manager->persist($empleadoJuan);
        $this->addReference('empleado-juan', $empleadoJuan); 

        $empleadoMaria = new Empleado();
        $empleadoMaria->setNombre('Maria');
        $empleadoMaria->setApellido('Gomez');
        $empleadoMaria->setEmail('maria.gomez@empresa.com');
        $empleadoMaria->setTelefono(1198765432);
        $empleadoMaria->setFechaIngreso(new \DateTime('2021-03-10'));
        $empleadoMaria->setSalario(45000);
        $empleadoMaria->setComision(0);
        $empleadoMaria->setPuesto($puestoAnalista);
        $manager->persist($empleadoMaria);
        $this->addReference('empleado-maria', $empleadoMaria);

        $empleadoCarlos = new Empleado();
        $empleadoCarlos->setNombre('Carlos');
        $empleadoCarlos->setApellido('Lopez');
        $empleadoCarlos->setEmail('carlos.lopez@empresa.com');
        $empleadoCarlos->setTelefono(1155554444);
        $empleadoCarlos->setFechaIngreso(new \DateTime('2022-07-20'));
        $empleadoCarlos->setSalario(65000);
        $empleadoCarlos->setComision(0);
        $empleadoCarlos->setPuesto($puestoDesarrollador);
        $manager->persist($empleadoCarlos);
        $this->addReference('empleado-carlos', $empleadoCarlos);

        $allJefes = [$empleadoJuan, $empleadoCarlos]; 
        $manager->flush(); 
        
        $departamentoVentas = new Departamento();
        $departamentoVentas->setNombre('Ventas');
        $departamentoVentas->setUbicacion($ubicacionBsAs);
        $departamentoVentas->setJefe($empleadoJuan);
        $manager->persist($departamentoVentas);
        
        $departamentoIT = new Departamento();
        $departamentoIT->setNombre('IT');
        $departamentoIT->setUbicacion($ubicacionMadrid);
        $departamentoIT->setJefe($empleadoCarlos);
        $manager->persist($departamentoIT);

        $manager->flush(); 

        $empleadoJuan->setDepartamento($departamentoVentas);
        $empleadoMaria->setDepartamento($departamentoVentas);
        $empleadoMaria->setJefe($empleadoJuan);
        $empleadoCarlos->setDepartamento($departamentoIT);
        $empleadoCarlos->setJefe($empleadoJuan); 

        $manager->flush(); 

        
        $historial1 = new HistorialPuesto();
        $historial1->setEmpleado($empleadoMaria);
        $historial1->setPuesto($puestoAnalista);
        $historial1->setDepartamento($departamentoVentas);
        $historial1->setFechaInicio(new \DateTime('2021-03-10'));
        $historial1->setFechaFin(new \DateTime('2023-01-01'));
        $manager->persist($historial1);
        $manager->flush(); 

       
        $allDepartamentos = [$departamentoVentas, $departamentoIT];

        
        for ($i = 0; $i < 10; $i++) {
            $departamento = new Departamento();
            $departamento->setNombre($faker->unique()->word() . ' Dept.');
            $departamento->setUbicacion($faker->randomElement($allUbicaciones));
            $departamento->setJefe($faker->randomElement($allJefes)); 
            $manager->persist($departamento);
            $allDepartamentos[] = $departamento; 
        }
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
            $empleado = new Empleado();
            $empleado->setNombre($faker->firstName());
            $empleado->setApellido($faker->lastName());
            $empleado->setEmail($faker->unique()->email());
            $empleado->setTelefono($faker->numberBetween(1000000000, 9999999999)); 
            $empleado->setFechaIngreso($faker->dateTimeBetween('-5 years', 'now')); 
            $empleado->setSalario($faker->numberBetween(25000, 90000)); 
            $empleado->setComision($faker->numberBetween(0, 5000));
            $empleado->setPuesto($faker->randomElement($allPuestos));
            $empleado->setDepartamento($faker->randomElement($allDepartamentos));
            $empleado->setJefe($faker->randomElement($allJefes));

            $manager->persist($empleado);
        }

       
        $manager->flush();
    }
}}