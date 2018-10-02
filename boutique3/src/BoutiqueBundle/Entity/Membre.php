

<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


use Symfony\Component\HttpFoundation\File\UploadedFile; 

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\ProduitRepository")
 */

class Produit

{

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_produit;

​

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=20)
     */
    private $reference;

​

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=20)
     */

    private $categorie;

​

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

​

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

​

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=20)
     */
    private $couleur;

​

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=5)
     */
    private $taille;

​

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="string", length=5)
     */
    private $public;

​

