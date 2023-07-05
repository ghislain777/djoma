<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReplayRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
  *   normalizationContext={"groups"={"lecture"}},
  *     denormalizationContext={"groups"={"ecriture"}},
  *     attributes={
  *         "pagination_client_items_per_page"=true,
  *         "order"={"id": "desc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * @ORM\Entity(repositoryClass=ReplayRepository::class)
 */
class Replay
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"comment":"ID"})
     *  @Groups({"lecture"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Nom"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Emission::class, inversedBy="replays")
     * @ORM\JoinColumn(nullable=true, name="emission", referencedColumnName="id")
     *  @Groups({"lecture", "ecriture"})
     */
    private $emission;

    /**
     * @ORM\Column(type="datetime", options={"comment":"Date de diffusion"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $datedediffusion;

    /**
     * @ORM\Column(type="string", length=800, nullable=true, options={"comment":"Description"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Photos d'illustration"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true,options={"comment":"reference"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $lien;

    /**
     * @ORM\Column(type="boolean", nullable=true , options={"comment":"Lien youtube?"})
     * @Groups({"lecture", "ecriture"})
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Vidéo"})
     * @Groups({"lecture", "ecriture"})
     */
    private $video;


    public function __construct() {
        $this->setYoutube(true);
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

    public function getDatedediffusion(): ?\DateTimeInterface
    {
        return $this->datedediffusion;
    }

    public function setDatedediffusion(\DateTimeInterface $datedediffusion): self
    {
        $this->datedediffusion = $datedediffusion;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getYoutube(): ?bool
    {
        return $this->youtube;
    }

    public function setYoutube(?bool $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getEmission(): ?Emission
    {
        return $this->emission;
    }

    public function setEmission(?Emission $emission): self
    {
        $this->emission = $emission;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }


}
