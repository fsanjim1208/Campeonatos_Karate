<?php

namespace App\Controller;
use \DateTime;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Provincia;
use App\Entity\Categoria;
use App\Entity\ComunidadAutonoma;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

use Doctrine\Persistence\ManagerRegistry;
class RegistrationController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userauthenticator,
        FormLoginAuthenticator $formLoginAuthenticator
    ): Response    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        $provincia= $this->doctrine
            ->getRepository(Provincia::class)
            ->findAll();

        $comunidad= $this->doctrine
        ->getRepository(ComunidadAutonoma::class)
        ->findAll();

        $categorias= $this->doctrine
        ->getRepository(Categoria::class)
        ->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            if($request->request->get('_password')==$form->get('plainPassword')->getData()){
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $provincia1= $this->doctrine
                ->getRepository(Provincia::class)
                ->findOneByNombre($request->request->get('provincia'));
                
                $peso=$request->request->get('peso');
                $sexo=$request->request->get('sexo');

                $user->setProvincia($provincia1);
                $user->setPeso($peso);
                // var_dump($request->request->get('fecha_nacimiento'));

                $user->setSexo($sexo);
                
                $fecha = new DateTime($request->request->get('fecha_nacimiento'));
                $hoy = new DateTime();
                $edad = $hoy->diff($fecha)->y;
                $user->setFechaNacimiento($fecha);
                foreach ($categorias as $categoria) {
                    if($peso<$categoria->getPesoMax() && $peso>=$categoria->getPesoMin() &&
                       $edad<$categoria->getEdadMax() && $edad>=$categoria->getEdadMin() &&
                       strcasecmp($sexo, $categoria->getSexo()) == 0)
                    {
                        //echo $categoria->getNombre();
                        $user->setCategoria($categoria);
                    }
                }


                $entityManager->persist($user);
                $entityManager->flush();
    
    
                $userauthenticator->authenticateUser(
                    $user,
                    $formLoginAuthenticator,
                    $request
                );
                // do anything else you need here, like send an email
    
                return $this->redirectToRoute('app_home');
            }
            else{
                $error="Las contraseñas deben ser iguales";
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                    'error'=>$error,
                    'comunidad'=>$comunidad,
                ]);
            }
            
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'provincia'=>$provincia,
            'comunidad'=>$comunidad,
        ]);
    }
}
