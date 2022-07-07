<?php

namespace App\Entity;

use App\Repository\EmissionradioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * * @ApiResource(
   *   normalizationContext={"groups"={"lecture"}},
   *     denormalizationContext={"groups"={"ecriture"}},
   *     attributes={
   *         "pagination_client_items_per_page"=true,
   *         "order"={"nom": "asc"}
   *     }
   * )
   * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * @ORM\Entity(repositoryClass=EmissionradioRepository::class)
 */
class Emissionradio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , options={"comment":"ID"})
     * @Groups({"lecture"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="emissionradios")
     *  @ORM\JoinColumn(nullable=false, name="categorie")
     * @Groups({"lecture", "ecriture"})
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255 , options={"comment":"Nom"})
     * @Groups({"lecture", "ecriture"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Description"})
     * @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Présentateur"})
     * @Groups({"lecture", "ecriture"})
     */
    private $presentateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Photo présentateur"})
     * @Groups({"lecture", "ecriture"})
     */
    private $photopresentateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true , options={"comment":"Photo émission"})
     * @Groups({"lecture", "ecriture"})
     */
    private $photoemission;

    /**
     * @ORM\OneToMany(targetEntity=Replayaudio::class, mappedBy="emissionradio")
     */
    private $replayaudios;

    public function __construct()
    {
        $this->replayaudios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPresentateur(): ?string
    {
        return $this->presentateur;
    }

    public function setPresentateur(?string $presentateur): self
    {
        $this->presentateur = $presentateur;

        return $this;
    }

    public function getPhotopresentateur(): ?string
    {
        return $this->photopresentateur;
    }

    public function setPhotopresentateur(?string $photopresentateur): self
    {
        $this->photopresentateur = $photopresentateur;

        return $this;
    }

    public function getPhotoemission(): ?string
    {
        return $this->photoemission;
    }

    public function setPhotoemission(?string $photoemission): self
    {
        $this->photoemission = $photoemission;

        return $this;
    }

    /**
     * @return Collection|Replayaudio[]
     */
    public function getReplayaudios(): Collection
    {
        return $this->replayaudios;
    }

    public function addReplayaudio(Replayaudio $replayaudio): self
    {
        if (!$this->replayaudios->contains($replayaudio)) {
            $this->replayaudios[] = $replayaudio;
            $replayaudio->setEmissionradio($this);
        }

        return $this;
    }

    public function removeReplayaudio(Replayaudio $replayaudio): self
    {
        if ($this->replayaudios->removeElement($replayaudio)) {
            // set the owning side to null (unless already changed)
            if ($replayaudio->getEmissionradio() === $this) {
                $replayaudio->setEmissionradio(null);
            }
        }

        return $this;
    }
}
