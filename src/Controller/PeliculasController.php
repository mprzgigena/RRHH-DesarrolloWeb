<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pelicula;
use App\Repository\PeliculaRepository; 

class PeliculasController extends AbstractController
{
    // Ruta 1: Listo todas las películas
    #[Route('/peliculas', name: 'app_peliculas_listado')]
    public function listado(PeliculaRepository $peliculaRepository): Response
    {
        $peliculas = $peliculaRepository->findAll();

        return $this->render('peliculas/listado.html.twig', [
            'peliculas' => $peliculas,
            'titulo' => 'Listado de todas las películas',
        ]);
    }

    // Ruta 2: Filtro películas por año de estreno
    #[Route('/peliculas/estreno/{año}', name: 'app_peliculas_estreno')]
    public function filtrarPorAnio(PeliculaRepository $peliculaRepository, int $año): Response
    {
        // Usamo findBy para filtrar por el campo 'año_estreno'
        $peliculas = $peliculaRepository->findBy(['año_estreno' => $año]);

        return $this->render('peliculas/listado.html.twig', [
            'peliculas' => $peliculas,
            'titulo' => 'Películas estrenadas en el año ' . $año,
            'no_resultados_mensaje' => 'No se encontraron películas estrenadas en el año ' . $año . '.',
        ]);
    }

    // Ruta 3: Busca películas por la primera letra del título
    #[Route('/peliculas/letra/{letra}', name: 'app_peliculas_letra')]
    public function buscarPorLetra(PeliculaRepository $peliculaRepository, string $letra): Response
    {
        // Validamos que la letra sea una sola y sea alfabética
        // Usaremos Query Builder para hacer la búsqueda 'LIKE letra%'
        $peliculas = $peliculaRepository->createQueryBuilder('p')
            ->where('p.nombre LIKE :letra')
            ->setParameter('letra', $letra . '%')
            ->getQuery()
            ->getResult();

        return $this->render('peliculas/listado.html.twig', [
            'peliculas' => $peliculas,
            'titulo' => 'Películas que comienzan con la letra "' . $letra . '"',
            'no_resultados_mensaje' => 'No se encontraron películas que comiencen con la letra "' . $letra . '".',
        ]);
    }
}