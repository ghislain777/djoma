<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * 
 *  @ApiResource(
  *   normalizationContext={"groups"={"lecture"}},
  *     denormalizationContext={"groups"={"ecriture"}},
  *     attributes={
  *         "pagination_client_items_per_page"=true,
  *         "order"={"id": "asc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "prenom": "partial"})
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="WDIDX16136965740", columns={"login"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment":"ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *  @Groups({"lecture"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false, options={"comment":"Nom"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motdepasse", type="string", length=45, nullable=true, options={"comment":"Mot de passe"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $motdepasse;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true, options={"comment":"Actif"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $actif;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datecreation", type="date", nullable=true, options={"comment":"Créé le"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $datecreation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=true, options={"comment":"Prénom"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true, options={"comment":"Email"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="civilite", type="string", length=4, nullable=true, options={"comment":"Civilite"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $civilite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=true, options={"comment":"Téléphone"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=true, options={"comment":"Login"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $login;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=true, name="role", referencedColumnName="id")
     *  @Groups({"lecture", "ecriture"})
     */
    private $role;

    


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"lecture", "ecriture"})
     */
    private $photo;


    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(?string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

   

}
