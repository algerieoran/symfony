<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use BoutiqueBundle\Entity\Produit;
use BoutiqueBundle\Entity\Membre;
use BoutiqueBundle\Entity\Commande;
use BoutiqueBundle\Entity\DetailsCommande;

use BoutiqueBundle\Form\ProduitType;
use BoutiqueBundle\Form\MembreType;
use BoutiqueBundle\Form\CommandeType;



class AdminController extends Controller
{

    /**
     * @Route("/admin/", name="home_admin")
    */
    public function homeAdminAction(){}





    /**
    * @Route("/admin/produit/show", name="show_produit")
    */
    public function produitShowAction(){
        $repository = $this -> getDoctrine() -> getRepository(Produit::class);
        $produits= $repository -> findAll();

        $params = array (
            'produits' => $produits,
            'title'  => 'Gestion des produits'
        );

        return $this -> render('@Boutique/Admin/show_produit.html.twig', $params);
    }





    /**
     * @Route("/admin/produit/add", name="add_produit") 
    */
   public function produitAddAction(Request $request) {

        $produit = new Produit; // objet vide

        // on récupère notre formulaire en lui passant l'objet qu'il représente
        $form = $this -> createForm(ProduitType::class, $produit);


      



        // Je génère le formulaire (HTML- la partie visuelle)
         $formView = $form -> createView();

        // permet de récupérer les données du post 
        $form -> handleRequest($request);
            if($form -> isSubmitted () && $form -> isValid()){
                // on verra plus tard la validation
            

                $em = $this -> getDoctrine () -> getManager();
                $em -> persist($produit);

                $produit -> chargementPhoto();

                $em -> flush();

                $session = $request -> getSession();
                $session -> getFlashBag() -> add('success', 'le produit est ajouté !');
                return $this -> redirectToRoute('show_produit');

            }

        $params = array(
            'produitForm' => $formView,
            'title'  => 'Ajouter un produit'
        );

        return $this -> render('@Boutique/Admin/form_produit.html.twig', $params);
    
    }




    /**
     * @Route("/admin/produit/update/{id}", name="update_produit") 
     * Route pour modifier un produit
     * principe générale : On hydrate le formulaire du produit
    */
    public function produitUpdateAction($id, Request $request) {
        $repository = $this -> getDoctrine() -> getRepository(Produit::class);
        $produit = $repository -> find($id);

        $form = $this -> createForm(ProduitType::class, $produit);

       
        $formView = $form -> createView();

        $form -> handleRequest($request);

        if($form -> isSubmitted () && $form -> isValid()){
            // on verra plus tard la validation
          

            $em = $this -> getDoctrine () -> getManager();
            $em -> persist($produit);

            $produit -> chargementPhoto();

            $em -> flush();

           

            $request -> getSession() -> getFlashBag() -> add('success', 'le produit a bien été modifier!');
            return $this -> redirectToRoute('show_produit');

        }

        


        $params = array(
            'produitForm' => $formView,
            'title' => 'Modifier le produit n°' . $id,
            'photo' => $produit -> getPhoto()
        );


    
        return $this -> render('@Boutique/Admin/form_produit.html.twig', $params);
    }


// yakine
//     <?php

// public function produitUpdateAction($id, Request $request){
		
// 		$repository = $this -> getDoctrine() -> getRepository(Produit::class);
// 		$produit = $repository -> find($id);
		
// 		$formBuilder = $this -> get('form.factory') -> createBuilder(FormType::class, $produit);

// 		$formBuilder			
// 			-> add('reference', TextType::class)
// 			-> add('categorie', TextType::class)
// 			-> add('titre', TextType::class)
// 			-> add('description', TextareaType::class)
// 			-> add('public', ChoiceType::class, array(
// 					'choices' => array(
// 						'Homme' => 'm',
// 						'Femme' => 'f'
// 					)
// 				))
// 			-> add('couleur', TextType::class)
// 			-> add('taille', TextType::class)
// 			-> add('photo', TextType::class)
// 			-> add('prix', TextType::class)
// 			-> add('stock', TextType::class)
// 			-> add('Modifier', SubmitType::class);
		
		
// 		$form = $formBuilder -> getForm();
		
// 		$formView = $form -> createView();
		
// 		$form -> handleRequest($request);
		
// 		if($form -> isSubmitted() && $form -> isValid()){
			
// 			$em = $this -> getDoctrine() -> getManager();
// 			$em -> persist($produit);
// 			$em -> flush();
			
// 			$session = $request -> getSession(); 
// 			//$session = $request -> get('session'); 
			
// 			$session -> getFlashBag -> add('success', 'Le produit a bien été modifié');
// 			return $this -> redirectToRoute('show_produit'); 
// 		}
		
// 		$params = array(
// 			'produitForm' => $formView,
// 			'title' => 'Modifier le produit n°' . $id
// 		);
		
// 		return $this -> render('@Boutique/admin/form_produit.html.twig', $params);	
// 	}




    /**
     * @Route("/admin/produit/delete/{id}", name="delete_produit") 
     * 
     * Route pour supprimer un produit de la BDD
     */

    public function produitDeleteAction($id) {
        // on récuper le produit via le manager .... parce qu'on en avoir besoin pour la suppression 
        $em = $this -> getDoctrine() -> getManager();
        $produit = $em -> find(Produit::class, $id);

        $em -> remove($produit);
        $em -> flush();


        $session = $request -> getSession();
        $session = $request -> getSession() -> getFlashBag() -> add("OK, le produit id: " . $id . " a été supprimé !"); 
        //return new Response ("OK, le produit id: " . $id . " a été supprimé !");

        // A tester :localhost:8000/produit/delete/14

        return $this -> redirectToRoute('show_produit');
    }


    /**
    * @Route("/admin/membre/show", name="show_membre")
    */
    public function membreShowAction(){
        $repository = $this -> getDoctrine() -> getRepository(Membre::class);
        $membres= $repository -> findAll();

        $params = array (
            'membres' => $membres,
            'title'  => 'Gestion des membres'
        );

        return $this -> render('@Boutique/Admin/show_membre.html.twig', $params);
    }

    /**
     * @Route("/admin/membre/add", name="add_membre") 
    */
    public function membreAddAction(Request $request) {

        $membre = new Membre; 

        // on récupère notre formulaire en lui passant l'objet qu'il représente
        $form = $this -> createForm(MembreType::class, $membre);


        // Je génère le formulaire (HTML- la partie visuelle)
         $formView = $form -> createView();

        // permet de récupérer les données du post 
        $form -> handleRequest($request);
            if($form -> isSubmitted () && $form -> isValid()){
                // on verra plus tard la validation
            

                $em = $this -> getDoctrine () -> getManager();
                $em -> persist($membre);

                // $membre -> chargementPhoto();

                $em -> flush();

                $session = $request -> getSession();
                $session -> getFlashBag() -> add('success', 'le nouveau membre est enregistré !');
                return $this -> redirectToRoute('show_membre');

            }

        $params = array(
            'membreForm' => $formView,
            'title'  => 'Ajouter un nouveau membre'
        );

        return $this -> render('@Boutique/Admin/form_membre.html.twig', $params);
    
    }

    /**
     * @Route("/admin/membre/update/{id}", name="update_membre") 
    */
    public function membreUpdateAction($id, Request $request) {
        $repository = $this -> getDoctrine() -> getRepository(Membre::class);
        $membre = $repository -> find($id);

        $form = $this -> createForm(MembreType::class, $membre);

       
        $formView = $form -> createView();

        $form -> handleRequest($request);

        if($form -> isSubmitted () && $form -> isValid()){
            // on verra plus tard la validation
          

            $em = $this -> getDoctrine () -> getManager();
            $em -> persist($membre);

            // $membre -> chargementPhoto();

            $em -> flush();

           

            $request -> getSession() -> getFlashBag() -> add('success', 'le membre a bien été modifier!');
            return $this -> redirectToRoute('show_membre');

        }

        $params = array(
            'membreForm' => $formView,
            'title' => 'Modifier le membre n°' . $id,
            // 'photo' => $membre -> getPhoto()
        );


    
        return $this -> render('@Boutique/Admin/form_membre.html.twig', $params);
    }



    /**
     * @Route("/admin/membre/delete/{id}", name="delete_membre") 
     * 
     */

    public function membreDeleteAction($id, Request $request) {
        // on récuper le membre via le manager .... parce qu'on en avoir besoin pour la suppression 
        $em = $this -> getDoctrine() -> getManager();
        $membre = $em -> find(Membre::class, $id);

        $em -> remove($membre);
        $em -> flush();


        $session = $request -> getSession();
        $session-> getFlashBag() -> add("OK, le membre id: " . $id . " a été supprimé !"); 
        

      

        return $this -> redirectToRoute('show_membre');
    }

    /**
     * @Route("admin/membre/profil/{id}", name="profil_membre")
     */
    public function profilMembreAction($id, Request $request)
    {
        $passwordEncoder = $this -> get('security.password_encoder');

       

        

        $membre = new Membre;
        $membre -> setStatut(0);
        $membre -> setRole('ROLE_USER');
        $form = $this -> createForm(MembreType::class, $membre);
        

            // Je génère le formulaire (HTML - partie visuel)
            $formView = $form -> createView();

            // permet de récupérer les données du poste
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid() ){
                // On verra plus tard la validation


                $salt = substr(md5(time()), 0, 23);
                // time() : 1545223656
                // time() crypté en MD5 : 52154dsqf6s5564g46g6f5s65s565g654
                // ON conserve du 0 au 23 ème caractères : 52154dsqf6s5564g46g6f5s65

                $password = $passwordEncoder -> encodePassword($membre, $salt);
                $membre -> setPassword($password) -> setSalt($salt);
                // On mets dans l'objet $membre le nouveau password (crypté) et le salt (génèré aléatoirement) afin que ces deux valeurs soient enregistrée en BDD.
                
                $em = $this -> getDoctrine() -> getManager();
                $em -> persist($membre);
                $em -> flush();

                $request -> getSession() -> getFlashBag() -> add('success', 'la fiche de l\' utilisateur  n° :' . $id);
                // return $this -> redirectToRoute('connexion');
            }



        $repository = $this -> getDoctrine() -> getRepository(Membre::class);
        $membre= $repository -> find($id);

        // $query = $em -> createQueryBuilder(); // Objet QueryBuilder

        // $query 
        // -> select ('m')
        // -> from (membre::class,'m')
        // -> where ('m.id_membre= :id_membre')
        // -> setParameter ('id_membre', $produit -> getId_membre());
       
        // $suggestions = $query -> getQuery() -> getResult();



        $params = array (    
            'title' => 'Le Profile des membres',
            'membreForm' => $formView,
            'membre' => $membre
            // 'suggestions' => $suggestions
           
        );

        var_dump($membre);

        return $this->render('@Boutique/Admin/profil_membre.html.twig' , $params);
    }

    














    
}