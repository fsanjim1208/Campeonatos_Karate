<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Provincia;
use App\Entity\User;
use App\Entity\ComunidadAutonoma;
use App\Form\ProvinciaType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/info', name: 'app_miInfo')]
    public function index(Security $security): Response
    {
        $token = $security->getToken();
        $user = $token->getUser();
        $comunidad=$user->getProvincia()->getComunidadAutonoma();
        return $this->render('usuario/infoUsu.html.twig', [
            'controller_name' => 'MiController',
            'comunidad'=>$comunidad,
        ]);
    }

    #[Route('/setAdmin/{id}', name: 'app_setAdmin')]
    public function admin($id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        
        $user->setRoles(['ROLE_ADMIN']);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('home/landingPage.html.twig');
    }



}