<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BoutiqueBundle\Entity\Produit;

class ProduitController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
    // methode numéro 1 pour récupérer un repository :
        //$repository = $this -> getDoctrine() -> getRepository('BoutiqueBundle\Entity\Produit'); 
        // OU :
        $repository = $this -> getDoctrine() -> getRepository(Produit::class);


        $produits = $repository -> findAll(); 


        // echo '<pre>';
        //     var_dump ($produits);
        // echo '</pre>';

        //SELECT DISTINCT categorie FROM produit :
        $em = $this -> getDoctrine() -> getManager();
        $query = $em -> CreateQuery("SELECT DISTINCT p.categorie FROM BoutiqueBundle\Entity\Produit p");
        $categories = $query -> getResult();


        $params = array(
            'produits'  => $produits,
            'categories'  => $categories,
            'title'  => 'Accueil'
        );


        return $this->render('@Boutique/Produit/index.html.twig', $params);
    }

    /**
     * @Route("/categorie/{categorie}", name="categorie")
     */

     public function categorieAction ($categorie) {

        $repository = $this -> getDoctrine() -> getRepository(Produit::class);
        $produits = $repository -> findBy(['categorie' => $categorie]); 

        
         //SELECT DISTINCT categorie FROM produit :
         $em = $this -> getDoctrine() -> getManager();
         $query = $em -> CreateQuery("SELECT DISTINCT p.categorie FROM BoutiqueBundle\Entity\Produit p");
         $categories = $query -> getResult();

         $params = array(
             'produits'  => $produits,
             'categories'  => $categories,
             'title'  => 'Page catégorie ' . $categorie
         );

         return $this -> render('@Boutique/Produit/index.html.twig', $params); 

     }

     /**
      * @Route("/produit/{id}", name="produit")
      */

      public function produitAction($id) {

        // methode numéro 1 :
        $repository = $this -> getDoctrine() -> getRepository(Produit::class);
        $produit = $repository -> find($id); 

        //methode 2 :
        // $em = $this -> getDoctrine() -> getManager();
        // $produit =$em -> find(Produit::class, $id);

        
        // On récupère les suggestions :
        $suggestions = $repository -> findBy(['categorie' => $produit -> getCategorie()]); 
    
        $params = array(
            'produit'  => $produit,
            'title'  => 'produit : ' .$produit -> getTitre(),
            'suggestions'  => $suggestions
        );
          
        return $this -> render('@Boutique/Produit/fiche_produit.html.twig', $params);
    
          
    }


    
}
