<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarcadorController extends AbstractController
{
    #[Route('/marcador', name: 'app_marcador')]
    public function index(): Response
    {

           $puntos = 0;
        // Aquí puedes agregar la lógica para sumar los puntos en función de las acciones del usuario

        return $this->render('marcador/marcador.html.twig', [
            'puntos' => $puntos,
            'tiempo' => '3:00' // Tiempo inicial
        ]);
    }
}
