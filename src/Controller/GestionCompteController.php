<?php

namespace App\Controller;

use App\Form\GestionCompte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class GestionCompteController extends AbstractController {

    /**
     * @Route("/monCompte", name="app_gestion_compte")
     */
    public function gestionCompte(Request $request) {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'User tried to access a page without having being connected');

        $user = $this->getUser();
        
        //Gestion du compted 
        //Changer numLicence, mail, numero de tel, mdp
        $user->getEmail();
        
//        $form = $this->createForm(GestionCompte::class, $user);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            
        
        
        return $this->render('utilisateur/gestionCompte.html.twig');
    }

}
