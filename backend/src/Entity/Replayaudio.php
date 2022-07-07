<?php

namespace App\Entity;

use App\Repository\ReplayaudioRepository;
use Doctrine\ORM\Mapping as ORM;
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
 * @ORM\Entity(repositoryClass=ReplayaudioRepository::class)
 */
class Replayaudio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , options={"comment":"ID"})
     * @Groups({"lecture"})
     */
    private $id;

   

    /**
     * @ORM\Column(type="datetime", nullable=true , options={"comment":"Date de diffucion"})
     * @Groups({"lecture", "ecriture"})
     */
    private $datedediffusion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Description"})
     * @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Photo"})
     * @Groups({"lecture", "ecriture"})
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255 , options={"comment":"Lien"})
     * @Groups({"lecture", "ecriture"})
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity=Emissionradio::class, inversedBy="replayaudios")
     *  @ORM\JoinColumn(nullable=false, name="emissionradio")
     * @Groups({"lecture", "ecriture"})
     */
    private $emissionradio;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Nom"} )
     * @Groups({"lecture", "ecriture"})
     */
    private $nom;

    public function __construct() {
        $this->datedediffusion = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDatedediffusion(): ?\DateTimeInterface
    {
        return $this->datedediffusion;
    }

    public function setDatedediffusion(?\DateTimeInterface $datedediffusion): self
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

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getEmissionradio(): ?Emissionradio
    {
        return $this->emissionradio;
    }

    public function setEmissionradio(?Emissionradio $emissionradio): self
    {
        $this->emissionradio = $emissionradio;

        return $this;
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
}
