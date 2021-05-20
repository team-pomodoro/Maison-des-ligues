<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AtelierType;
use App\Form\ThemeType;
use App\Form\VacationType;
use App\Entity\Theme;
use App\Entity\Vacation;
use App\Repository\ThemeRepository;
use App\Repository\VacationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * 
 * @Route("/creation/", name="creation_")
 */
class CreationController extends AbstractController
{
    /**
     * 
     * @Route("atelier", name="atelier")
     */
    public function creationAtelier(Request $request, EntityManagerInterface $manager)
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $atelier = new Atelier();
        $theme = new Theme();
        $vacation = new Vacation();

        $form = $this->createForm(AtelierType::class, $atelier);
        $formTheme = $this->createForm(ThemeType::class, $theme);
        $formVacation = $this->createForm(VacationType::class, $vacation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($atelier);
            $manager->flush();
            $this->addFlash('success', ' L\'atelier a bien été enregistré');
            return $this->redirectToRoute('creation_atelier');
        }
        return $this->render(
            'creation/atelier/creerAtelier.html.twig',
            [
                'form' => $form->createView(),
                'formTheme' => $formTheme->createView(),
                'formVacation' => $formVacation->createView()
            ]
        );
    }

    


    /**
     * Route permettant de créer un thème
     * @Route("theme/creer", name="creerTheme")
     */
    public function creationTheme(Request $request, EntityManagerInterface $manager, AtelierRepository $arepo)
    {
        $theme = new Theme();

        $formTheme = $this->createForm(ThemeType::class, $theme);

        $formTheme->handleRequest($request);
        if ($formTheme->isSubmitted() && $formTheme->isValid()) {

            if ($_POST['theme']['ateliers']) {
                foreach ($_POST['theme']['ateliers'] as $formatelier) {
                    $atelier = $arepo->find($formatelier);
                    $theme->addAtelier($atelier);
                    $atelier->addTheme($theme);
                }
            }
            $manager->persist($theme);
            $manager->flush();
            if ($_POST['theme']['ateliers']) {
                $manager->persist($atelier);
                $manager->flush();
            }
            $this->addFlash('success', ' Le thème a bien été enregistré');
            return $this->redirectToRoute('creation_voirtousthemes');
        }
        return $this->render(
            'creation/theme/creerTheme.html.twig',
            [
                'formTheme' => $formTheme->createView()
            ]
        );
    }

   

    /**
     * Route permettant de créer une vacation
     * @Route("vacation/creer", name="creerVacation")
     */
    public function creationVacation(Request $request, EntityManagerInterface $manager)
    {
        $vacation = new Vacation();

        $formVacation = $this->createForm(VacationType::class, $vacation);

        $formVacation->handleRequest($request);
        if ($formVacation->isSubmitted() && $formVacation->isValid()) {

            $dateDeb = $formVacation->get('dateHeureDebut')->getData();
            $Deb = $dateDeb->format('d/n/Y');
            $dateFin = $formVacation->get('dateHeureFin')->getData();
            $fin = $dateFin->format('d/n/Y');
            if ($dateDeb < $dateFin && $Deb === $fin) {

                $mois_fr = array(
                    "", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
                    "septembre", "octobre", "novembre", "décembre"
                );

                $hDeb = $dateDeb->format('H:i');
                $hFin = $dateFin->format('H:i');
                list($jour, $mois, $annee) = explode('/', $Deb);
                $vacation->setLibelle("Le " . $jour . " " . $mois_fr[$mois] . " de " . $hDeb . " à " . $hFin);


                $manager->persist($vacation);
                $manager->flush();
                $this->addFlash('success', ' La vacation a bien été enregistrée');
                return $this->redirectToRoute('creation_voirtousvacations');
            } else {
                $this->addFlash('warning', 'La date de fin de la vacation n\'est pas conforme à la date de début');
            }
        }
        return $this->render(
            'creation/vacation/creerVacation.html.twig',
            [
                'formVacation' => $formVacation->createView()
            ]
        );
    }


    /**
     * Liste de tous les ateliers
     * @Route("voirtousateliers", name="voirtousateliers")
     */
    public function voirAteliertous(AtelierRepository $repo)
    {
        $ateliers = $repo->findAll();

        return $this->render('creation/atelier/voirtous.html.twig', ['ateliers' => $ateliers]);
    }

    /**
     * Liste de tous les themes
     * @Route("voirtousthemes", name="voirtousthemes")
     */
    public function voirThemestous(ThemeRepository $trepo)
    {
        $themes = $trepo->findAll();

        return $this->render('creation/theme/voirtous.html.twig', ['themes' => $themes]);
    }

    /**
     * Liste de toutes les vacations
     * @Route("voirtousvacation", name="voirtousvacations")
     */
    public function voirVacationtous(VacationRepository $repo)
    {
        $vacations = $repo->findAll();

        return $this->render('creation/vacation/voirtous.html.twig', ['vacations' => $vacations]);
    }

    /**
     * Modification d'un atelier à partir de la liste des ateliers
     * @Route("editAtelier/{id}", name="editAtelier")
     */
    public function editAtelier(Request $request, EntityManagerInterface $manager, Atelier $atelier)
    {

        $form = $this->createForm(AtelierType::class, $atelier);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($atelier);
            $manager->flush();
            $this->addFlash('success', ' L\'atelier a bien été modifié');
            return $this->redirectToRoute('creation_voirtousateliers');
        }
        return $this->render(
            'creation/atelier/editAtelier.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Route permettant de modifier un thème
     * @Route("theme/edit/{id}", name="editTheme")
     */
    public function editTheme(Request $request, EntityManagerInterface $manager, Theme $theme, AtelierRepository $arepo)
    {
        $formTheme = $this->createForm(ThemeType::class, $theme);
        foreach ($theme->getAteliers() as $atelier) {
            $theme->removeAtelier($atelier);
            $atelier->removeTheme($theme);
        }
        $formTheme->handleRequest($request);
        if ($formTheme->isSubmitted() && $formTheme->isValid()) {
            if ($_POST['theme']['ateliers']) {
                foreach ($_POST['theme']['ateliers'] as $formatelier) {
                    $atelier = $arepo->find($formatelier);
                    $theme->addAtelier($atelier);
                    $atelier->addTheme($theme);
                }
            }
            $manager->persist($theme);
            $manager->flush();
            if ($_POST['theme']['ateliers']) {
                $manager->persist($atelier);
                $manager->flush();
            }
            $this->addFlash('success', ' Le thème a bien été modifié');
            return $this->redirectToRoute('creation_voirtousthemes');
        }
        return $this->render(
            'creation/theme/editTheme.html.twig',
            [
                'formTheme' => $formTheme->createView()
            ]
        );
    }

    /**
     * Route permettant de modifier une vacation
     * @Route("vacation/edit/{id}", name="editVacation")
     */
    public function editVacation(Request $request, EntityManagerInterface $manager, Vacation $vacation)
    {

        $formVacation = $this->createForm(VacationType::class, $vacation);

        $formVacation->handleRequest($request);
        if ($formVacation->isSubmitted() && $formVacation->isValid()) {

            $dateDeb = $formVacation->get('dateHeureDebut')->getData();
            $Deb = $dateDeb->format('d/n/Y');
            $dateFin = $formVacation->get('dateHeureFin')->getData();
            $fin = $dateFin->format('d/n/Y');
            if ($dateDeb < $dateFin && $Deb === $fin) {

                $mois_fr = array(
                    "", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
                    "septembre", "octobre", "novembre", "décembre"
                );

                $hDeb = $dateDeb->format('H:i');
                $hFin = $dateFin->format('H:i');
                list($jour, $mois, $annee) = explode('/', $Deb);
                $vacation->setLibelle("Le " . $jour . " " . $mois_fr[$mois] . " de " . $hDeb . " à " . $hFin);


                $manager->persist($vacation);
                $manager->flush();
                $this->addFlash('success', ' La vacation a bien été modifiée');
                return $this->redirectToRoute('creation_voirtousvacations');
            } else {
                $this->addFlash('warning', 'La date de fin de la vacation n\'est pas conforme à la date de début');
            }
        }
        return $this->render(
            'creation/vacation/editVacation.html.twig',
            [
                'formVacation' => $formVacation->createView()
            ]
        );
    }
}