<?php
 
namespace App\Controller\ApiController;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Participa;
use App\Entity\Campeonato;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
 

#[Route('/api',name:"api_")]
class ApiParticipacionesController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/participaciones',name:"participaciones_show_all", methods:"GET")]
    public function show_all_provincia(Request $request): Response
    {
        $participaciones = $this->doctrine
                        ->getRepository(Participa::class)
                        ->findAll();
        if(!$participaciones){
            return $this->json("No hay participaciones", 404);
        }
        
        $participacionesArray=[];

        
        foreach ($participaciones as $participacion) {
            $participacionesArray[] = [
                'id' => $participacion->getId(),
                'user' => $participacion->getUser()->getId(),
                'campeonato' => $participacion->getCampeonato()->getId(),
            ];
        }
        return $this->json($participacionesArray);
    }

    #[Route('/participaciones',name:"participaciones_new", methods:"POST")]
    public function new(Request $request): Response
    {
        $entityManager = $this->doctrine->getManager();
     
        $campeonato = $entityManager->getRepository(Campeonato::class)->findOneById($request->request->get('campeonato'));
        //var_dump($campeonato);
        $participacion = new Participa();
        $participacion->setUser($this->getUser());
        $participacion->setCampeonato($campeonato);

        // $arrayParticipaciones[] = [
        //     'user' => $participacion->getUser()->getId(),
        //     'campeonato' => $participacion->getCampenato()->getId(),
        // ];

        $entityManager->persist($participacion);
        $entityManager->flush();
 
        return $this->json(['Creada la nueva participacion con id ' . $participacion->getId(), 'codigo: 201'], 201);
    }
}