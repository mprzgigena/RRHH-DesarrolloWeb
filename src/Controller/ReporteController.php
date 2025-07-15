<?php



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Filtro\ProvinciaFiltroType; 
use App\Repository\ProvinciaRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted; 

#[Route('/reportes')]
#[IsGranted('ROLE_ADMIN')] 
class ReporteController extends AbstractController
{
    #[Route('/', name: 'app_reporte_index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProvinciaRepository $provinciaRepository): Response
    {
       
        $form = $this->createForm(ProvinciaFiltroType::class);
        $form->handleRequest($request);

        $provincias = []; 

        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); 

            
            $criteria = [];
            if (!empty($data['pais'])) {
                $criteria['pais'] = $data['pais'];
            }
            if (!empty($data['minPoblacion'])) {
                $criteria['minPoblacion'] = $data['minPoblacion'];
            }
            if (!empty($data['maxSuperficie'])) {
                $criteria['maxSuperficie'] = $data['maxSuperficie'];
            }

            
            $provincias = $provinciaRepository->findByFiltro($criteria);
        } else {
            
            $provincias = $provinciaRepository->findAll();
        }

        return $this->render('reporte/index.html.twig', [
            'form_filtro' => $form->createView(), 
            'provincias' => $provincias, 
        ]);
    }
}