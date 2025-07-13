<?php


namespace App\Service;

use DateTime;

class FechaService
{
    private string $formatoFecha;

    public function __construct(string $formato)
    {
        $this->formatoFecha = $formato;
    }

    public function formatearFecha(DateTime $fecha = null): string
    {
        if ($fecha === null) {
            $fecha = new DateTime();
        }
        return $fecha->format($this->formatoFecha);
    }
}