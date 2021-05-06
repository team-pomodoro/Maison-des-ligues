<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CompteRepository;
use App\Repository\LicencieRepository;
use App\Entity\Licencie;
use Symfony\Component\HttpFoundation\Response;

trait Referer {

    private function getRefererParams() {
        $request = $this->getRequest();
        $referer = $request->headers->get('referer');
        $baseUrl = $request->getBaseUrl();
        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));
        return $this->get('router')->getMatcher()->match($lastPath);
    }

}

class RegistrationController extends Controller {

    private CompteRepository $compteRepository;
    private LicencieRepository $licencieRepository;

    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManagerCompte) {

        $this->licencieRepository = $entityManagerCompte->getRepository(Licencie::class);
        $this->compteRepository = $entityManagerCompte->getRepository(Compte::class);
        // 1) build the form
        $user = new Compte();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            if ($this->compteRepository->numLicenceExist($user->getNumLicence())) {
                //                var_dump($this->compteRepository->numLicenceExist($user->getNumLicence()));exit;


                $this->addFlash('warning', 'Un compte possède deja ce numéro de licence');

                $referer = $request->headers->get('referer');
                return $this->redirect($referer);

//            return $this->redirectToRoute('app_login');
            } elseif ($this->licencieRepository->numLicenceExiste($user->getNumLicence())) {
                 //// créer le lien d'activation
                $urlActive = $this->randString();
                $user->setUrlActive($urlActive);
                
                //persister les donénes
                $entityManager = $this->getDoctrine()->getManager();


                $entityManager->persist($user);
                $entityManager->flush();
                
               
                ///envoyer lien avec url active

                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('warning', 'Ce numero de licence n\'existe pas');
                $referer = $request->headers->get('referer');
                return $this->redirect($referer);
            }
        }
        return $this->render(
                        'security/register.html.twig',
                        array('form' => $form->createView())
        );
    }
    
    
    
    /**
     * @Route("/register/{id}", name="user_registration_validate")
     */
    public function registerValidate(string $id, Request $request, EntityManagerInterface $entityManagerCompte): Response {
        
        $this->compteRepository = $entityManagerCompte->getRepository(Compte::class);
        
        
        if($this->compteRepository->urlActiveExist($id)) {
            
        }
        
        return $this->render('security/registerValid.html.twig');
    }
    
    
    
    
    

    function randString($length = 20) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $string;
    }

}
