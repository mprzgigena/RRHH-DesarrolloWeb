<?php

namespace App\Controller;

use App\Form\PaisType;
use App\Repository\PaisRepository;
use App\Repository\ProvinciaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use App\Form\Filtro\ProvinciaFiltroType;
use App\Entity\Pais;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

final class ProvinciaController extends AbstractController
{
    #[Route('/provincia', name: 'provincia_index', methods: ['GET'])]
    public function index(ProvinciaRepository $provinciaRepository): Response
    {
        return $this->render('provincia/index.html.twig', [
            'provincias' => $provinciaRepository->findAll(),
        ]);
    }
    
    #[Route('/provincia/reporte', name: 'provincia_reporte')] 
    public function reporteProvinciaAction(Request $request, ProvinciaRepository 
    $provinciaRepository): Response 
    { 
        $form = $this->createForm(ProvinciaFiltroType::class); 
        $form->handleRequest($request); 
 
        $provincias = $provinciaRepository->findAll(); 
 
        if ($form->isSubmitted() && $form->isValid()) { 
            $data = $form->getData(); 
 
            $pais = null; 
            $minPoblacion = null; 
            $maxSuperficie = null; 
 
            if (isset($data['pais'])) { 
                $pais = $data['pais']; 
            } 
 
            if (isset($data['minPoblacion'])) { 
                $minPoblacion = $data['minPoblacion']; 
            } 
 
            if (isset($data['maxSuperficie'])) { 
                $maxSuperficie = $data['maxSuperficie']; 
            } 
 
            $provincias = $provinciaRepository->filtrar($pais, $minPoblacion, 
$maxSuperficie); 
        } 
 
        return $this->render('reportes/provinciaReporte.html.twig', [ 
            'form_filtro' => $form->createView(), 
            'provincias' => $provincias, 
        ]); 
    }

    
    #[Route('/provincia/exportar/excel', name: 'reporte_excel')] 
    public function exportarExcel(Request $request, PaisRepository $paisRepository, 
    ProvinciaRepository $provinciaRepository): StreamedResponse 
    { 
        $paisId = $request->query->get('pais'); 
        $minPoblacion = $request->query->get('minPoblacion'); 
        $maxSuperficie = $request->query->get('maxSuperficie'); 
 
        $pais = null; 
        if ($paisId) { 
            $pais = $paisRepository->find($paisId); 
        } 
 
        $provincias = $provinciaRepository->filtrar( 
            $pais, 
            $minPoblacion ? (int) $minPoblacion : null, 
            $maxSuperficie ? (float) $maxSuperficie : null 
        ); 
 
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet(); 
        $sheet->setTitle('Provincias'); 
        $sheet->fromArray(['Provincia', 'País', 'Población', 'Superficie (km²)'], 
    null, 'A1'); 
 
        $row = 2; 
        foreach ($provincias as $provincia) { 
            $sheet->setCellValue("A$row", $provincia->getNombre()); 
            $sheet->setCellValue("B$row", $provincia->getPais()?->getNombre() ?? 
    'Sin país'); 
            $sheet->setCellValue("C$row", $provincia->getPoblacion()); 
            $sheet->setCellValue("D$row", $provincia->getSuperficie()); 
            $row++; 
        } 
        $response = new StreamedResponse(function () use ($spreadsheet) { 
            $writer = new Xlsx($spreadsheet); 
            $writer->save('php://output'); 
        }); 
 
        $disposition = $response->headers->makeDisposition( 
            ResponseHeaderBag::DISPOSITION_ATTACHMENT, 
            'reporte_provincias.xlsx' 
        ); 
 
        $response->headers->set('Content-Type', 
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        $response->headers->set('Content-Disposition', $disposition); 
 
        return $response; 
    } 

   
    #[Route('/provincia/exportar/pdf', name: 'provincia_exportar_pdf')] 
    public function exportarPdf( 
        Request $request, 
        PaisRepository $paisRepository, 
        ProvinciaRepository $provinciaRepository 
    ): Response { 
        $paisId = $request->query->get('pais'); 
        $minPoblacion = $request->query->get('minPoblacion'); 
        $maxSuperficie = $request->query->get('maxSuperficie'); 
    
        $pais = null; 
        if ($paisId) { 
            $pais = $paisRepository->find($paisId); 
        } 
    
        $provincias = $provinciaRepository->filtrar( 
            $pais, 
            $minPoblacion ? (int)$minPoblacion : null, 
            $maxSuperficie ? (float)$maxSuperficie : null 
        ); 
    
        $html = $this->renderView('reportes/provinciaReporteXlsx.html.twig', [ 
            'provincias' => $provincias, 
        ]); 
    
        $options = new Options(); 
        $options->get('defaultFont', 'DejaVu Sans'); 
        $dompdf = new Dompdf($options); 
        $dompdf->loadHtml($html); 
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->render(); 
    
        return new Response( 
            $dompdf->output(), 
            200, 
            [ 
                'Content-Type' => 'application/pdf', 
                'Content-Disposition' => 'attachment; filename="reporte_provincias.pdf"', 
            ] 
        ); 
    } 

}