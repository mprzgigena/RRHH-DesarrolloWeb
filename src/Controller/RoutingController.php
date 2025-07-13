<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RoutingController extends AbstractController
{

    #[Route("/", name: "app_homepage")]
    public function index(): Response
    {
       
        return $this->render('index.html.twig', [
            'nombre' => 'Mariano' 
        ]);
    }

// --- Ejercicio 1: Controladores simples (Saludo y Despedida) ---

    
    #[Route("/saludo/{nombre}", name: "app_saludo")]
    public function saludo(string $nombre): Response
    {
        $mensaje = "¡Hola, $nombre! Bienvenido/a al sistema.";
        
        
        $urlDespedida = $this->generateUrl('app_despedida', ['nombre' => $nombre]);
        $enlace = "<a href='$urlDespedida'>Ir a despedida</a>";

        return new Response("$mensaje<br><br>$enlace");
    }

    
    #[Route("/despedida/{nombre}", name: "app_despedida")]
    public function despedida(string $nombre): Response
    {
        $mensaje = "Hasta luego, $nombre! Nos vemos pronto.";
        
       
        $urlSaludo = $this->generateUrl('app_saludo', ['nombre' => $nombre]);
        $enlace = "<a href='$urlSaludo'>Volver al saludo</a>";

        return new Response("$mensaje<br><br>$enlace");
    }

// --- Ejercicio 2: Jugar con múltiples parámetros (Estado de Ánimo) ---

  
    #[Route("/estado/{nombre}/{estado}", name: "app_estado_animo")]
    public function estadoDeAnimo(string $nombre, string $estado = null): Response
    {
        if ($estado) {
            $mensaje = "Hola $nombre, veo que hoy estás $estado";
        } else {
           
            $mensaje = "Hola $nombre, ¿cómo estás hoy?";
        }
        
        return new Response($mensaje);
    }

// --- Ejercicio 4: Mensaje aleatorio ---

 
    #[Route("/aleatorio", name: "app_aleatorio")]
    public function aleatorio(): Response
    {
        $saludos = ['¡Hola!', '¡Buenas tardes!', '¡Qué tal!', '¡Saludos cordiales!'];
        $nombres = ['Juan', 'Marta', 'Luis', 'Ana', 'Carlos'];

       
        $saludoAleatorio = $saludos[array_rand($saludos)];
        $nombreAleatorio = $nombres[array_rand($nombres)];

        $mensaje = "$saludoAleatorio, $nombreAleatorio!";

        return new Response($mensaje);
    }

// --- Ejercicio 5: Formulario (GET y POST) ---

  
    #[Route("/registro", name: "app_registro", methods: ["GET", "POST"])]
    public function registro(Request $request): Response
    {
      
        if ($request->isMethod('POST')) {
            $nombre = $request->request->get('nombre');
            $correo = $request->request->get('correo');

           
            return new Response("
                <h1>Datos Recibidos:</h1>
                <p>Nombre: $nombre</p>
                <p>Correo: $correo</p>
            ");
        }

        
        $formularioHtml = '
            <h1>Registro de Usuario</h1>
            <form action="/registro" method="post">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="correo">Correo:</label><br>
                <input type="email" id="correo" name="correo" required><br><br>
                <button type="submit">Enviar</button>
            </form>
        ';

        return new Response($formularioHtml);
    }

// --- Ejercicio 6: JSON (API) ---


    #[Route("/api/usuario/{id}", name: "api_usuario")]
    public function apiUsuario(int $id): JsonResponse
    {
       
        $usuario = [
            'id' => $id,
            'nombre' => 'Mariano Perez Gigena ' . $id,
            'correo' => 'usuario' . $id . 'mpg@ejemplo.com',
            'status' => 'activo'
        ];

        
        return new JsonResponse($usuario);
    }

// --- Ejercicio 7: Condicionales en PHP ---

 
    #[Route("/mayoria-edad/{edad}", name: "app_mayoria_edad")]
    public function mayoriaEdad(int $edad): Response
    {
        $edadLegal = 18;

        if ($edad >= $edadLegal) {
            $mensaje = "Tienes $edad años. Eres mayor de edad.";
        } else {
            $mensaje = "Tienes $edad años. Eres menor de edad.";
        }

        return new Response($mensaje);
    }
}