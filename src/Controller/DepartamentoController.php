<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Form\DepartamentoType;
use App\Repository\DepartamentoRepository; // Importa el repositorio
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/departamento')]
#[IsGranted('ROLE_ADMIN')] 
class DepartamentoController extends AbstractController
{
    #[Route('/new', name: 'app_departamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $departamento = new Departamento();

        $form = $this->createForm(DepartamentoType::class, $departamento);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($departamento);
            $entityManager->flush();

            $this->addFlash('success', 'Departamento creado con éxito.');

           
            return $this->redirectToRoute('app_departamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('departamento/new.html.twig', [
            'form' => $form,
        ]);
    }

   
    #[Route('/', name: 'app_departamento_index', methods: ['GET'])]
    public function index(DepartamentoRepository $departamentoRepository): Response
    {
        
        $departamentos = $departamentoRepository->findAll();

      
        return $this->render('departamento/index.html.twig', [
            'departamentos' => $departamentos,
        ]);
    }
}