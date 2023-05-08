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
class ApiProvinciaController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/provincia',name:"provincia_show_all", methods:"GET")]
    public function show_all_provincia(Request $request): Response
    {
        $provincias = $this->doctrine
                        ->getRepository(Provincia::class)
                        ->findAll();
 
        

        if(!$provincias){
            return $this->json("No hay provincias", 404);
        }
        
        $provinciasArray=[];

        
        foreach ($provincias as $provincia) {
            $provinciasArray[] = [
                'id' => $provincia->getId(),
                'nombre' => $provincia->getNombre(),
                'comunidad' => $provincia->getComunidadAutonoma()->getNombre(),
                'id_comunidad' => $provincia->getComunidadAutonoma()->getId()
            ];
        }
        return $this->json($provinciasArray);
    }
}