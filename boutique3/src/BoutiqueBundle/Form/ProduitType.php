<?php

namespace BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType; // input type text
use Symfony\Component\Form\Extension\Core\Type\FormType; // input type text
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // input type text
use Symfony\Component\Form\Extension\Core\Type\IntregerType; // input type text
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // input type text


use Symfony\Component\Validator\Constraints as Assert;



class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('reference', TextType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Veuillez remplire ce champs'
                )), 
                new Assert\Length(array(
                    'min' => 3,
                    'max' => 20,
                    'minMessage' => 'Veuillez saisir mini 3 caractères',
                    'maxMessage' => 'Veuillez saisir max 20 caractères'
                ))
            )
        ))
        ->add('categorie')
        ->add('titre')
        ->add('description')
        ->add('couleur')
        ->add('taille')
        ->add('public')
        ->add('photo')
        ->add('prix')
        ->add('stock')
        ->add('enregistrer');
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoutiqueBundle\Entity\Produit'
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boutiquebundle_produit';
    }


}
