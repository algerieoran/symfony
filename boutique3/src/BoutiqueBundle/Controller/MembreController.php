<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BoutiqueBundle\Entity\Membre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; // input type text
use Symfony\Component\Form\Extension\Core\Type\PasswordType;// input type password
use Symfony\Component\Form\Extension\Core\Type\IntegerType;// input type number
use Symfony\Component\Form\Extension\Core\Type\EmailType;// input type email
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;// input type choicetype
use Symfony\Component\Form\Extension\Core\Type\SubmitType;// input type submit



class MembreController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request)
    {
        $membre = new Membre;

        $form =$this -> createForm(MembreType::class, $membre);

        // Je génère le formulaire (HTML- la partie visuelle)
        $formView = $form -> createView();

        // permet de récupérer les données du post 
        $form -> handleRequest($request);
        if($form -> isSubmitted () && $form -> isValid()){
            // on verra plus tard la validation
          

            $em = $this -> getDoctrine () -> getManager();
            $em -> persist($membre);
            $em -> flush();

            $request -> getSession() -> getFlashBag() -> add('success', 'Félicitation, vous êtes inscrit !');

            return $this -> redirectToRoute('connexion');


        }

        

      $params = array(
        'membreForm' => $formView,
        //'membres' => $membres,
        'title'  => 'Inscription'
       );

        return $this -> render('@Boutique/Membre/inscription.html.twig', $params);
    
    }


    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexionAction()
    {
    // methode numéro 1 pour récupérer un repository :
        //$repository = $this -> getDoctrine() -> getRepository('BoutiqueBundle\Entity\Membre'); 
        // OU :
        // $repository = $this -> getDoctrine() -> getRepository(Membre::class);


        // $membres = $repository -> findAll(); 


        // echo '<pre>';
        //     var_dump ($membres);
        // echo '</pre>';

        

         $params = array(

         'title'  => 'Connexion'
     );

        return $this -> render('@Boutique/Membre/connexion.html.twig', $params);
    
    }

    /**
     * @Route("membre/update/{id}")
     */
    public function membreUpdateAction ($id) {

        $em = $this -> getDoctrine() -> getManager();
        $membre = $em -> find (Membre::class, $id);

        $membre -> setPrenom('Romain');

        $em -> persist($membre);
        $em -> flush();

        return new Response ("OK, le membre id: " . $id . " a été modifier");

        // tester : http://localhost:8000/membre/update/15

    }

    /**
     * @Route("membre/delete/{id}")
     */
    public function membreDeleteAction ($id) {
        $em = $this -> getDoctrine() -> getManager();
        $membre = $em -> find(Membre::class, $id);

        $em -> remove($membre);
        $em -> flush();

        return new Response ("OK, le membre id: " . $id . " a été supprimé !");

        // A tester :localhost:8000/membre/delete/14

    }
    
}
