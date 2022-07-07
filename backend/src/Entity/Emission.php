<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmissionRepository;
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
  *         "order"={"id": "asc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * @ORM\Entity(repositoryClass=EmissionRepository::class)
 */
class Emission
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
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Présentateur"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $presentateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Photo présentateur"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $photopresentateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Photo émission"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $photoemission;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="emissions")
     * @ORM\JoinColumn(nullable=true, name="categorie", referencedColumnName="id")
     *  @Groups({"lecture", "ecriture"})
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Replay::class, mappedBy="emission")
     */
    private $replays;

   

    public function __construct()
    {
        $this->replays = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Replay[]
     */
    public function getReplays(): Collection
    {
        return $this->replays;
    }

    public function addReplay(Replay $replay): self
    {
        if (!$this->replays->contains($replay)) {
            $this->replays[] = $replay;
            $replay->setEmission($this);
        }

        return $this;
    }

    public function removeReplay(Replay $replay): self
    {
        if ($this->replays->removeElement($replay)) {
            // set the owning side to null (unless already changed)
            if ($replay->getEmission() === $this) {
                $replay->setEmission(null);
            }
        }

        return $this;
    }


}
