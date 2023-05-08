<?php
 
namespace App\Controller\ApiController;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;
use App\Entity\ComunidadAutonoma;
use Doctrine\Persistence\ManagerRegistry;
 

#[Route('/api',name:"api_")]
class ApiComunidadAutonomaController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/comunidad',name:"comunidad_show_all", methods:"GET")]
    public function show_all_comunidades(Request $request): Response
    {
        $comunidades = $this->doctrine
                        ->getRepository(ComunidadAutonoma::class)
                        ->findAll();
 
        

        if(!$comunidades){
            return $this->json("No hay comunidades", 404);
        }
        
        $comunidadesArray=[];

        
        foreach ($comunidades as $comunidad) {
            $comunidadesArray[] = [
                'id' => $comunidad->getId(),
                'nombre' => $comunidad->getNombre(),
            ];
        }
        return $this->json($comunidadesArray);
    }
}