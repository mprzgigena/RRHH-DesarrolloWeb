<?php


namespace App\Service;

class CalculadoraService
{
    public function sumar(float $num1, float $num2): float
    {
        return $num1 + $num2;
    }

    public function restar(float $num1, float $num2): float
    {
        return $num1 - $num2;
    }

    public function multiplicar(float $num1, float $num2): float
    {
        return $num1 * $num2;
    }

    public function dividir(float $num1, float $num2): ?float
    {
        if ($num2 === 0.0) {
            return null;
        }
        return $num1 / $num2;
    }
}