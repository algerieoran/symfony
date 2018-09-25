<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {

        $produits = array (
            0 => array(
                'id_produit'   => 1,
                'reference'    =>  '12354',
                'categorie'    =>  'pull',
                'description'  => 'super pull pou l\'hiver',
                'titre'        =>  'Pull noir',  
                'couleur'      =>'noir',
                'taille'       =>'m',
                'public'       =>'f',
                'photo'        =>'pull_femme1.jpg',
                'prix'         =>'15.00',
                'stock'        =>'150'
            ),
            1 => array(
               'id_produit'   => 2,
               'reference'    =>  'DFF854',
               'categorie'    =>  'Bottes',
               'description'  => 'Botte au top',
               'titre'        =>  'Botte de cowboy',  
               'couleur'      =>'blanc',
               'taille'       =>'m',
               'public'       =>'f',
               'photo'        =>'p01_pull1.jpg',
               'prix'         =>'50.00',
               'stock'        =>'250'
            )
        );

        $categories = array (
            0 => array (
               'categorie'    => 'pull'         
           ),
           
           1 => array (      
               'categorie'    => 'bottes'
           )
        );

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

     public function categorieAction () 
     {
         $produits = array (
             0 => array(
                 'id_produit'   => 1,
                 'reference'    =>  '12354',
                 'categorie'    =>  'pull',
                 'description'  => 'super pull pou l\'hiver',
                 'titre'        =>  'Pull noir',  
                 'couleur'      =>'noir',
                 'taille'       =>'m',
                 'public'       =>'f',
                 'photo'        =>'pull_femme1.jpg',
                 'prix'         =>'15.00',
                 'stock'        =>'150'
             ),
             1 => array(
                'id_produit'   => 2,
                'reference'    =>  'DFF854',
                'categorie'    =>  'Bottes',
                'description'  => 'Botte au top',
                'titre'        =>  'Botte de cowboy',  
                'couleur'      =>'blanc',
                'taille'       =>'m',
                'public'       =>'f',
                'photo'        =>'p01_pull1.jpg',
                'prix'         =>'50.00',
                'stock'        =>'250'
             )
         );

         $categories = array (
             0 => array (
                'categorie'    => 'pull'         
            ),
            
            1 => array (      
                'categorie'    => 'bottes'
            )
         );

         $params = array(
             'produits'  => $produits,
             'categories'  => $categories,
             'title'  => 'Accueil'
         );

         return $this -> render('@Boutique/Produit/index.html.twig', $params); 

     }

     /**
      * @Route("/produit/{id}", name="produit")
      */

      public function produitAction() 

      {
            $produit = array (
                'id_produit'   => 1,
                'reference'    =>  '12354',
                'categorie'    =>  'pull',
                'description'  => 'super pull pou l\'hiver',
                'titre'        =>  'Pull noir',  
                'couleur'      =>'noir',
                'taille'       =>'m',
                'public'       =>'f',
                'photo'        =>'pull_femme1.jpg',
                'prix'         =>'15.00',
                'stock'        =>'150'
            );
   
            $params = array(
                'produit'  => $produit,
                'title'  => 'produit : ' .$produit['titre']
            );    
   

         
        

          $suggestions = array (

            0 => array(
                'id_produit'   => 1,
                'reference'    =>  '12354',
                'categorie'    =>  'pull',
                'description'  => 'super pull pou l\'hiver',
                'titre'        =>  'Pull noir',  
                'couleur'      =>'noir',
                'taille'       =>'m',
                'public'       =>'f',
                'photo'        =>'p01_pull1.jpg',
                'prix'         =>'15.00',
                'stock'        =>'150'
            ),
    
            1 => array(
               'id_produit'   => 2,
               'reference'    =>  'DFF854',
               'categorie'    =>  'Bottes',
               'description'  => 'Botte au top',
               'titre'        =>  'Botte de cowboy',  
               'couleur'      =>'blanc',
               'taille'       =>'m',
               'public'       =>'f',
               'photo'        =>'2_robe.jpg',
               'prix'         =>'50.00',
               'stock'        =>'250'
            )
        );
    
        $params = array(
            'produit'  => $produit,
            'suggestions'  => $suggestions,
            'title'  => 'produit : ' .$produit['titre']
        );
          
        return $this -> render('@Boutique/Produit/fiche_produit.html.twig', $params);
    
          
    }


    
}
