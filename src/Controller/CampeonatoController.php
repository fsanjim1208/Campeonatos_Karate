<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Provincia;
use App\Entity\User;
use App\Entity\Campeonato;
use App\Entity\ComunidadAutonoma;
use App\Form\CampeonatoType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ManagerRegistry;
use \DateTime;

class CampeonatoController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/newCampeonato', name: 'app_newCampeonato')]
    public function index(
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {
        $campeonato = new Campeonato();
        $form = $this->createForm(CampeonatoType::class, $campeonato);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $fecha_inicio= $fecha = new DateTime($request->request->get('fecha_inicio'));
            $campeonato->setFechaInicio($fecha_inicio);

            $tipo=$request->request->get('tipo');
            $campeonato->setTipo($tipo);

            if($tipo=="Autonomico"){
                $comunidad=$this->doctrine
                ->getRepository(ComunidadAutonoma::class)
                ->findOneByNombre($request->request->get('comunidad'));
                $campeonato->setComunidadAutonoma($comunidad);
            }

            $entityManager->persist($campeonato);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        else{
            $error="Las contraseñas deben ser iguales";
            return $this->render('campeonato/newCampeonato.html.twig', [
                'form' => $form->createView(),
                'error'=>$error,
            ]);
        }
        
    

        return $this->render('campeonato/newCampeonato.html.twig', [
            'controller_name' => 'MiController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/allCampeonatos', name: 'app_allCampeonato')]
    public function showAllCampeonatos(
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {

        $campeonatos=$this->doctrine
        ->getRepository(Campeonato::class)
        ->findAll();

        return $this->render('campeonato/viewAllCampeonato.html.twig', [
            'controller_name' => 'MiController',
            'campeonatos'=>$campeonatos
        ]);
    }

    #[Route('/manteCampeonato', name: 'app_manteCampeonato')]
    public function manteCampeonatos(
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {

        $campeonatos=$this->doctrine
        ->getRepository(Campeonato::class)
        ->findAll();

        return $this->render('campeonato/mantenimientoCampeonato.html.twig', [
            'controller_name' => 'MiController',
            'campeonatos'=>$campeonatos
        ]);
    }




}