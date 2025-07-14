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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Fixtures para Películas y Directores (Manteniendo los datos anteriores) ---

        // Director
        $director1 = new Director();
        $director1->setNombreDirector('Steven Spielberg');
        $manager->persist($director1);

        $director2 = new Director();
        $director2->setNombreDirector('Quentin Tarantino');
        $manager->persist($director2);

        // Películas
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

        // --- Fixtures para Recursos Humanos ---

        // 1. Paises
        $pais1 = new Pais();
        $pais1->setNombre('Argentina');
        $manager->persist($pais1);

        $pais2 = new Pais();
        $pais2->setNombre('España');
        $manager->persist($pais2);

        // 2. Provincias (depende de Pais)
        $provincia1 = new Provincia();
        $provincia1->setNombre('Buenos Aires');
        $provincia1->setPais($pais1);
        $manager->persist($provincia1);

        $provincia2 = new Provincia();
        $provincia2->setNombre('Córdoba');
        $provincia2->setPais($pais1);
        $manager->persist($provincia2);

        $provincia3 = new Provincia();
        $provincia3->setNombre('Madrid');
        $provincia3->setPais($pais2);
        $manager->persist($provincia3);

        // 3. Puestos
        $puesto1 = new Puesto();
        $puesto1->setNombre('Gerente');
        $puesto1->setSalarioMinimo(50000);
        $puesto1->setSalarioMaximo(100000);
        $manager->persist($puesto1);

        $puesto2 = new Puesto();
        $puesto2->setNombre('Analista');
        $puesto2->setSalarioMinimo(30000);
        $puesto2->setSalarioMaximo(60000);
        $manager->persist($puesto2);

        $puesto3 = new Puesto();
        $puesto3->setNombre('Desarrollador');
        $puesto3->setSalarioMinimo(40000);
        $puesto3->setSalarioMaximo(80000);
        $manager->persist($puesto3);

        // 4. Ubicaciones (depende de Provincia)
        $ubicacion1 = new Ubicacion();
        $ubicacion1->setCalle('Av. Corrientes 123');
        $ubicacion1->setCodigoPostal('C1043AAB');
        $ubicacion1->setCiudad('Buenos Aires');
        $ubicacion1->setProvincia($provincia1);
        $manager->persist($ubicacion1);

        $ubicacion2 = new Ubicacion();
        $ubicacion2->setCalle('C/ Gran Vía 45');
        $ubicacion2->setCodigoPostal('28013');
        $ubicacion2->setCiudad('Madrid');
        $ubicacion2->setProvincia($provincia3);
        $manager->persist($ubicacion2);

        // 5. Empleados (primera carga sin departamento ni jefe)
        // Usaremos referencias para establecer las relaciones de jefe y departamento más tarde.
        $empleado1 = new Empleado();
        $empleado1->setNombre('Juan');
        $empleado1->setApellido('Perez');
        $empleado1->setEmail('juan.perez@empresa.com');
        $empleado1->setTelefono(1123456789);
        $empleado1->setFechaIngreso(new \DateTime('2020-01-15'));
        $empleado1->setSalario(80000);
        $empleado1->setComision(0);
        $empleado1->setPuesto($puesto1); // Gerente
        $manager->persist($empleado1);
        $this->addReference('empleado-juan', $empleado1); // Referencia para Jefe

        $empleado2 = new Empleado();
        $empleado2->setNombre('Maria');
        $empleado2->setApellido('Gomez');
        $empleado2->setEmail('maria.gomez@empresa.com');
        $empleado2->setTelefono(1198765432);
        $empleado2->setFechaIngreso(new \DateTime('2021-03-10'));
        $empleado2->setSalario(45000);
        $empleado2->setComision(0);
        $empleado2->setPuesto($puesto2); // Analista
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
        $empleado3->setPuesto($puesto3); // Desarrollador
        $manager->persist($empleado3);
        $this->addReference('empleado-carlos', $empleado3);

        // 6. Departamentos (depende de Ubicacion y Empleado (Jefe))
        $departamento1 = new Departamento();
        $departamento1->setNombre('Ventas');
        $departamento1->setUbicacion($ubicacion1);
        $departamento1->setJefe($empleado1); // Juan Perez es el jefe
        $manager->persist($departamento1);
        $this->addReference('departamento-ventas', $departamento1);

        $departamento2 = new Departamento();
        $departamento2->setNombre('IT');
        $departamento2->setUbicacion($ubicacion2);
        $departamento2->setJefe($empleado3); // Carlos Lopez es el jefe
        $manager->persist($departamento2);
        $this->addReference('departamento-it', $departamento2);

        // 7. Actualizar Empleados con Departamento y Jefe (si aplica)
        $empleado1->setDepartamento($departamento1); // Juan Perez en Ventas
        $empleado2->setDepartamento($departamento1); // Maria Gomez en Ventas
        $empleado2->setJefe($empleado1); // Maria Gomez reporta a Juan Perez
        $empleado3->setDepartamento($departamento2); // Carlos Lopez en IT
        $empleado3->setJefe($empleado1); // Carlos Lopez reporta a Juan Perez

        // 8. Historial de Puestos (depende de Empleado, Puesto, Departamento)
        $historial1 = new HistorialPuesto();
        $historial1->setEmpleado($empleado2);
        $historial1->setPuesto($puesto2);
        $historial1->setDepartamento($departamento1);
        $historial1->setFechaInicio(new \DateTime('2021-03-10'));
        $historial1->setFechaFin(new \DateTime('2023-01-01'));
        $manager->persist($historial1);

        $manager->flush();
    }
}