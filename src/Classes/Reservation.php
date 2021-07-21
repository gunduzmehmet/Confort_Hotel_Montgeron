<?php


namespace App\Classes;

use App\Repository\ArticlesRepository;
use App\Repository\ChambresRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Reservation
{
    private $session;
    private $articleRepository;

    // injection de dépendance//
    public function __construct(SessionInterface $session, ChambresRepository $chambresRepository, ArticlesRepository $articleRepository)
    {;
        $this->session = $session;
        $this->articleRepository = $articleRepository;
    }

    /**
     * function qui ajoute un article au panier qui sera passé dans les param de la function
     */

    public function add_chambres_panier($variable)
    {
        //je crée un tableau

        $panier = $this->session->get('panier', []);

        //je teste le panier si la variable existe

        if (!empty($panier[$variable])) {
            //si elle existe je rajoute à la quantité 1
            $panier[$variable] = $panier[$variable] + 1;
        } else {
            //sinon je créé la donnée avec une valeur de 1
            $panier[$variable] = 1;
        }

        //je renvoi à l'objet session les nouvelles valeur du panier
        $this->session->set('panier', $panier);
    }

    /**
     * function qui retourne le panier de
     */
    public function getPanier()
    {
        return $this->session->get('panier', []);
    }

    /**
     * function qui supprime tout le panier
     */
    public function deletePanier()
    {
        $this->session->remove('panier');
    }


    /**
     * function qui supprime un article du panier par son id
     */
    public function deleteArticlePanier($id)
    {
        // je vais get le panier
        $panier = $this->getPanier();
        // je verifie si le produit existe
        if (!empty($panier[$id])) {
            //si existe, je supprime
            unset($panier[$id]);
        }

        //je renvoie à l'objet session les nouvelles valeurs de mon panier

        $this->session->set('panier', $panier);
    }

    /**
     * function qui ajoute 5 articles au panier
     */

     public function ajoute5()
     {
         $panier=$this->getPanier();
         // ajoute 5 nouveaux article au panier
         for ( $i = 1 ; $i <= 5 ; $i++)
         {
             $panier[$i] = 1 ;
         }

         //je renvoi a l'objet 
         $this->session->set('panier', $panier);
     }

/**
     * function qui retire 1 a la quantité d'un panier
     */

    public function deleteUnArtcicle($id)
    {
        // je get le panier avec notre méthode
        $panier=$this->getPanier();
        //je test si la quantité est superieur à 1

        if($panier[$id] > 1)
        {
            //je retire 1 ala quantité

            $panier[$id] = $panier[$id] - 1 ;
        }
        else{
            //supprime l'article du panier

            unset($panier[$id]);
        }

        //je renvoi à l'objet session les nouvelles valeur du panier
        $this->session->set('panier', $panier);
    }



    /**
     * récupére le panier avec le détail de l'article
    */

    public function getDetailPanier() 
    {
        $panier =$this->getPanier();

        $detail_panier = [];

        foreach( $panier as $id => $valeur)
        {
            $article = $articleRepository->find($id);

            $detail_panier[]=[
                'article' => $article,
            ];
        }

        return $detail_panier ;
    }


}
