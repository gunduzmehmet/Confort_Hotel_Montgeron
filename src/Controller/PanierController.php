<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classes\Reservation;
use App\Classes\Panier;

class PanierController extends AbstractController
{
   // private $panier;

   // public function __construct(Panier $panier)
   // {
    //    $this->panier = $panier;
  //  }

    /**
     * @Route("/panier", name="panier")
     */
    public function index(Reservation $panier): Response
    {
        return $this->render('panier/index.html.twig', [
            //je get le panier par la methode getpanier de lobjet $panier
            'panier' => $panier->getPanier()
        ]);
    }

    /**
     * @Route("/ajouter-panier/{id}", name="add_panier")
     */
    public function addChambrePanier($id, Reservation $panier): Response
    {
        //j'appelle la methode de notre classe panier (add_chambre_panier)
        $panier->add_chambres_panier($id);

        //ensuite je renvoie vers la vue panier
        return $this->redirectToRoute('panier');
    }

     /**
     * @Route("/supprimer-panier", name="delete_panier")
     */
    public function deletePanier(Reservation $panier): Response
    {
        //j'appele la fonction deletepanier denotre classe pour supprimer tout le panier
        $panier->deletePanier();
        // et je redirige vers la vue du panier
        return $this->redirectToRoute('panier');

    }

     /**
     * @Route("/supprime-panier/{id}", name="delete_article_panier")
     */
    public function deleteArticlePanier($id, Reservation $panier): Response
    {
        //j'appelle la methode de notre classe panier (add_chambre_panier)
        $panier->deleteArticlePanier($id);

        //ensuite je renvoie vers la vue panier
        return $this->redirectToRoute('panier');
    }

     /**
     * @Route("/ajouter-panier", name="add_5_panier")
     */
    public function add5Panier( Reservation $panier): Response
    {
        //j'appelle la function ajoute5 pour ajouter 5 
        $panier->ajoute5();

        //ensuite je renvoie vers la vue panier
        return $this->redirectToRoute('panier');
    }

     /**
     * @Route("/supprime-un-panier/{id}", name="delete_un_article_panier")
     */
    public function deleteUnArticlePanier($id, Reservation $panier): Response
    {
        //j'appelle la methode de notre classe panier (delete_un_article_panier)
        $panier->deleteArticlePanier($id);

        //ensuite je renvoie vers la vue panier
        return $this->redirectToRoute('panier');
    }

    
}
