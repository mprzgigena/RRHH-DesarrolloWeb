<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted; 

class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    #[IsGranted(attribute: 'ROLE_ADMIN')] 
    public function index(): Response
    {
        $titulo = 'Información sobre mi perfil.';
       
        
        $contenido = 'Nombre: Pepe Rodriguez <br> Email: pepito@dominio.com';

        return $this->render('perfil.html.twig', [
            'titulo' => $titulo,
            'contenido' => $contenido,
        ]);
    }
}