<?php

namespace App\Controller;

use App\Form\GestionCompte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CompteRepository;
use App\Entity\Compte;

class GestionCompteController extends AbstractController {

    /**
     * @Route("/monCompte", name="app_gestion_compte")
     */
    public function gestionCompte(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManagerCompte) {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'User tried to access a page without having being connected');

        $user = $this->getUser();
        
        //Gestion du compted 
        //Changer numLicence, mail, numero de tel, mdp
        $user->getEmail();
        
        
        
        //modifier
        
        $this->compteRepository = $entityManagerCompte->getRepository(Compte::class);
        // 1) build the form
        $user = $this->getUser();
        $form = $this->createForm(GestionCompte::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            if ($this->compteRepository->numLicenceExist($user->getNumLicence())) {
//                var_dump($this->compteRepository->numLicenceExist($user->getNumLicence()));exit;


                $this->addFlash('warning', 'uh oh, that didn\'t quite work right');

                $referer = $request->headers->get('referer');
                return $this->redirect($referer);

//            return $this->redirectToRoute('app_login');
            } else {
                $entityManager = $this->getDoctrine()->getManager();


                $entityManager->persist($user);
                $entityManager->flush();
                //// ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user
                return $this->redirectToRoute('app_gestion_compte');
            }
        }
        
        
        
        return $this->render('utilisateur/gestionCompte.html.twig',
                array('form' => $form->createView()));
    }
    
    
//        public function modifier(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManagerCompte) {
//
//        $this->compteRepository = $entityManagerCompte->getRepository(Compte::class);
//        // 1) build the form
//        $user = $this->getUser();
//        $form = $this->createForm(GestionCompte::class, $user);
//
//        // 2) handle the submit (will only happen on POST)
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            // 3) Encode the password (you could also do this via Doctrine listener)
//            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
//            $user->setPassword($password);
//
//            // 4) save the User!
//            if ($this->compteRepository->numLicenceExist($user->getNumLicence())) {
////                var_dump($this->compteRepository->numLicenceExist($user->getNumLicence()));exit;
//
//
//                $this->addFlash('warning', 'uh oh, that didn\'t quite work right');
//
//                $referer = $request->headers->get('referer');
//                return $this->redirect($referer);
//
////            return $this->redirectToRoute('app_login');
//            } else {
//                $entityManager = $this->getDoctrine()->getManager();
//
//
//                $entityManager->persist($user);
//                $entityManager->flush();
//                //// ... do any other work - like sending them an email, etc
//                // maybe set a "flash" success message for the user
//                return $this->redirectToRoute('app_login');
//            }
//        }
//
//        return $this->render(
//                        'security/register.html.twig',
//                        array('form' => $form->createView())
//        );
//    }

}
