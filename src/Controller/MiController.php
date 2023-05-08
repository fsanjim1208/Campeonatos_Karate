<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Provincia;
use App\Form\ProvinciaType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MiController extends AbstractController
{
    #[Route('/mi', name: 'app_mi')]
    public function index(): Response
    {
        return $this->render('mi/index.html.twig', [
            'controller_name' => 'MiController',
        ]);
    }
    
    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/landingPage.html.twig');
    }

    #[Route('/provincia', name: 'app_newProvincia')]
    public function register(
        Request $request, 
        EntityManagerInterface $entityManager,
    ): Response    {
        $provincia = new Provincia();
        $form = $this->createForm(ProvinciaType::class, $provincia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            // encode the plain password


            $entityManager->persist($provincia);
            $entityManager->flush();


        }
        
        return $this->render('provincia/newProvincia.html.twig', [
            'provincia' => $form->createView(),
        ]);
    }
}
