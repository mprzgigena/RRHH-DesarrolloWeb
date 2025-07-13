<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CalculadoraService; 

class CalculadoraController extends AbstractController
{
   
    public function __construct(private CalculadoraService $calculadoraService)
    {
    }

    #[Route('/calculadora', name: 'app_calculadora')]
    public function index(): Response
    {
        $num1 = 10;
        $num2 = 5;

        $suma = $this->calculadoraService->sumar($num1, $num2);
        $resta = $this->calculadoraService->restar($num1, $num2);
        $multiplicacion = $this->calculadoraService->multiplicar($num1, $num2);
        $division = $this->calculadoraService->dividir($num1, $num2);
        $divisionPorCero = $this->calculadoraService->dividir($num1, 0); 

        $output = "<h1>Resultados de la Calculadora:</h1>";
        $output .= "<p>Suma: $num1 + $num2 = $suma</p>";
        $output .= "<p>Resta: $num1 - $num2 = $resta</p>";
        $output .= "<p>Multiplicación: $num1 * $num2 = $multiplicacion</p>";
        $output .= "<p>División: $num1 / $num2 = $division</p>";
        $output .= "<p>División por Cero ($num1 / 0): " . ($divisionPorCero === null ? "Indefinido" : $divisionPorCero) . "</p>";

        return new Response($output);
    }
}