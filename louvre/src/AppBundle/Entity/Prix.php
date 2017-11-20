<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * prix
 *
 * @ORM\Table(name="prix")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrixRepository")
 */
class Prix
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Billet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $billet;

    const NORMAL = 16;
    const ENFANT = 8;
    const SENIOR = 12;
    const REDUIT = 10;




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Prix
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Prix
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set billet
     *
     * @param \AppBundle\Entity\Billet $billet
     *
     * @return Prix
     */
    public function setBillet(\AppBundle\Entity\Billet $billet)
    {
        $this->billet = $billet;

        return $this;
    }

    /**
     * Get billet
     *
     * @return \AppBundle\Entity\Billet
     */
    public function getBillet()
    {
        return $this->billet;
    }
}
