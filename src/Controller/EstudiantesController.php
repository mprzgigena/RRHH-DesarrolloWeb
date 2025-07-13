<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EstudiantesController extends AbstractController
{
    // Datos de estudiantes (Ejercicio 1 y Herencia Vertical)
    private $estudiantes = [
        ['nombre' => 'Ana', 'nota' => 8],
        ['nombre' => 'Luis', 'nota' => 5],
        ['nombre' => 'Marta', 'nota' => 9],
    ];

    // Datos de cursos (Ejercicio 4)
    private $cursos = [
        '1A' => [
            ['nombre' => 'Ana', 'nota' => 8],
            ['nombre' => 'Luis', 'nota' => 5],
        ],
        '2B' => [
            ['nombre' => 'Marta', 'nota' => 9],
            ['nombre' => 'Tomás', 'nota' => 4],
        ],
    ];

    // --- Ejercicio 1: Template simple (Index de estudiantes) ---
    #[Route('/estudiantes', name: 'app_estudiantes')]
    public function index(): Response
    {
 
        return $this->render('estudiantes/index.html.twig', [
            'estudiantes' => $this->estudiantes,
        ]);
    }

    // --- Ejercicio 4: Agrupar estudiantes por curso ---
    #[Route('/cursos', name: 'ver_cursos')]
    public function cursos(): Response
    {
       
        return $this->render('estudiantes/cursos_por_estudiantes.html.twig', [
            'cursos' => $this->cursos,
        ]);
    }

    // --- Ejercicio 4 (Herencia Vertical): Vista de estudiantes ---
    
    #[Route("/estudiantes/lista", name: "app_estudiantes_lista")]
    public function listaEstudiantes(): Response
    {
        return $this->render('estudiantes/vista.html.twig', [
            'estudiantes' => $this->estudiantes,
        ]);
    }
}