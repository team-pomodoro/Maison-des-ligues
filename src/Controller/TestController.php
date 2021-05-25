<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Compte;

class TestController extends AbstractController {

    /**
     * @Route("/test", name="app_test")
     */
    public function test(Request $request) {
        
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');
        
        //verifie que l'utilisateur est validé
        $user = new Compte();
        $user = $this->getUser();
        if($user->getActive() == false){
            return $this->redirectToRoute('app_logout');
        }
        
        return $this->render('utilisateur/test.html.twig');
    }

}
