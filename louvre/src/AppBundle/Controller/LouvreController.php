<?php
/**
 * Created by PhpStorm.
 * User: stefa
 * Date: 16/10/2017
 * Time: 18:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Billet;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\UtilisateurAdresse;
use AppBundle\Form\BilletType;
use AppBundle\Form\CommandeType;
use AppBundle\Form\UtilisateurAdresseType;
use AppBundle\Form\UtilisateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LouvreController extends Controller
{
    /**
     * @Route("/louvre")
     */
    public function accueilAction()
    {
        return $this->render(':louvre:accueil.html.twig');
    }

    /**
     * @Route("/louvre/selection")
     */
    public function selectionAction()
    {

        return $this->render(':louvre:selection.html.twig');
    }

    /**
     * @Route("/louvre/panier")
     */
    public function panierAction(Request $request)
    {

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class,$commande);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($commande->getBillets());
                $em->persist($commande);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Billet bien enregistré.');
                return $this->redirectToRoute('info_fac', array('idCmd' => $commande->getId(), 'idUser' => $commande->getUtilisateur()->getId()));
            }
        }
        return $this->render(':louvre:panier.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/louvre/info_facturation/commande:{idCmd}/utilisateur:{idUser}", name="info_fac")
     */
    public function infoFacturationAction(Request $request, $idCmd, $idUser)
    {
        $utilisateur = new UtilisateurAdresse();
        $form = $this->createForm(UtilisateurAdresseType::class, $utilisateur);
        if ($request->isMethod('POST'))
        {
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                return $this->redirectToRoute('app_louvre_recap', array('idCommande' => $idCmd, 'idUtilisateur' => $utilisateur->getId()));
            }
        }

        return $this->render(':louvre:infoFacturation.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/louvre/recap/{id}")
     */
    public function recapAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Billet')
        ;

        $billet = $repository->find($id);

        return$this->render(':louvre:recapPanier.html.twig', array('billet' => $billet));
    }

    /**
     * @Route("/louvre/payement/commande:{id}")
     */
    public function payementAction()
    {
        return $this->render(':louvre:payement.html.twig');
    }

    public function addAction(Request $request)
    {
        if ($request->isMethod('POST'))
        {

        }


    }

}
