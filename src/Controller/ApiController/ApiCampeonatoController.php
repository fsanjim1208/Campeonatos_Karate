<?php
 
namespace App\Controller\ApiController;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Campeonato;
use App\Entity\ComunidadAutonoma;
use Doctrine\Persistence\ManagerRegistry;
 

#[Route('/api',name:"api_")]
class ApiCampeonatoController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/campeonato/{id}',name:"campeonato_show", methods:"GET")]
    public function showCampeonato(int $id): Response
    {
        $campeonato = $this->doctrine
            ->getRepository(Campeonato::class)
            ->find($id);
 
        if (!$campeonato) {
 
            return $this->json('No hay campeonato por esa id: ' . $id, 404);
        }
 
        
        $arrayCampeonatos = [
            'id' => $campeonato->getId(),
            'nombre' => $campeonato->getNombre(),
            'participantes' => $campeonato->getNMaxParticipantes(),
            'fecha_Inicio' => $campeonato->getFechaInicio(),
            'tipo' => $campeonato->getTipo(),
            'comunidad' => $campeonato->getComunidadAutonoma()->getNombre(),
            'cartel' => $campeonato->getCartel(),
        ];

        return $this->json($arrayCampeonatos);
    }

}