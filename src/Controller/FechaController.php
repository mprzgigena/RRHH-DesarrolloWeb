<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\FechaService; 
use DateTime;

class FechaController extends AbstractController
{
    
    public function __construct(private FechaService $fechaService)
    {
    }

    #[Route('/fecha-actual', name: 'app_fecha_actual')]
    public function index(): Response
    {
        $fechaActualFormateada = $this->fechaService->formatearFecha();
        
        
        $otraFecha = new DateTime('2025-04-21 17:35:00');
        $otraFechaFormateada = $this->fechaService->formatearFecha($otraFecha);

        $output = "<h1>Fecha Actual:</h1>";
        $output .= "<p>Fecha actual: $fechaActualFormateada</p>";
        $output .= "<p>Otra fecha (21/04/2025 17:35): $otraFechaFormateada</p>";

        return new Response($output);
    }
}