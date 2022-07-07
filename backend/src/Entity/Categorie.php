<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
  *   normalizationContext={"groups"={"lecture"}},
  *     denormalizationContext={"groups"={"ecriture"}},
  *     attributes={
  *         "pagination_client_items_per_page"=true,
  *         "order"={"id": "asc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Description"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Photo"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Emission::class, mappedBy="categorie")
     */
    private $emissions;

    /**
     * @ORM\OneToMany(targetEntity=Emissionradio::class, mappedBy="categorie")
     */
    private $emissionradios;

    public function __construct()
    {
        $this->emissions = new ArrayCollection();
        $this->emissionradios = new ArrayCollection();
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

    /**
     * @return Collection|Emission[]
     */
    public function getEmissions(): Collection
    {
        return $this->emissions;
    }

    public function addEmission(Emission $emission): self
    {
        if (!$this->emissions->contains($emission)) {
            $this->emissions[] = $emission;
            $emission->setCategorie($this);
        }

        return $this;
    }

    public function removeEmission(Emission $emission): self
    {
        if ($this->emissions->removeElement($emission)) {
            // set the owning side to null (unless already changed)
            if ($emission->getCategorie() === $this) {
                $emission->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Emissionradio[]
     */
    public function getEmissionradios(): Collection
    {
        return $this->emissionradios;
    }

    public function addEmissionradio(Emissionradio $emissionradio): self
    {
        if (!$this->emissionradios->contains($emissionradio)) {
            $this->emissionradios[] = $emissionradio;
            $emissionradio->setCategorie($this);
        }

        return $this;
    }

    public function removeEmissionradio(Emissionradio $emissionradio): self
    {
        if ($this->emissionradios->removeElement($emissionradio)) {
            // set the owning side to null (unless already changed)
            if ($emissionradio->getCategorie() === $this) {
                $emissionradio->setCategorie(null);
            }
        }

        return $this;
    }
}
