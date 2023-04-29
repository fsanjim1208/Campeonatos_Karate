<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiController extends AbstractController
{
    #[Route('/mi', name: 'app_mi')]
    public function index(): Response
    {
        return $this->render('mi/index.html.twig', [
            'controller_name' => 'MiController',
        ]);
    }
}
