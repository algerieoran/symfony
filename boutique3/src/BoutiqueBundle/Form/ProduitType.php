<?php

namespace BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FormType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\IntegerType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; 
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType; 


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


        ->add('categorie', TextType::class, array(
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


        ->add('titre', TextType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Veuillez remplire ce champs' 
                )),

                new Assert\Length(array(
                    'min' => 3,
                    'max' => 255,
                    'minMessage' => 'Veuillez saisir mini 3 caractères',
                    'maxMessage' => 'Veuillez saisir max 20 caractères'
                ))
            )

        ))



        ->add('description', TextareaType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Veuillez remplire ce champs' 
                ))
            )
        ))
        ->add('couleur', TextType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Veuillez remplire ce champs' 
                )),

                new Assert\Length(array(
                    'min' => 3,
                    'max' => 255,
                    'minMessage' => 'Veuillez saisir mini 3 caractères',
                    'maxMessage' => 'Veuillez saisir max 20 caractères'
                ))
            )
        ))

        ->add('taille', TextType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Veuillez remplire ce champs' 
                )),

                new Assert\Length(array(
                    'min' => 3,
                    'max' => 255,
                    'minMessage' => 'Veuillez saisir mini 3 caractères',
                    'maxMessage' => 'Veuillez saisir max 20 caractères'
                ))
            )
        ))

        ->add('public', ChoiceType::class, array(
            'required' => false,
            'choices' => array(
                'Homme' => 'm',
                'Femme' => 'f'

           
            )
        ))

        ->add('file', FileType::class, array(
            'required' => false,
            'constraints' => array(
                new Assert\File(array(
                    'maxSize' => '3M',
                    'maxSizeMessage' => 'Veuillez uploader une image de 3 Mo maximum'
                )),
            )
        ))

        ->add('prix', MoneyType::class, array(
            'required' => false
        ))
        ->add('stock', IntegerType::class, array(
            'required' => false
        ))
        ->add('save', SubmitType::class);
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
