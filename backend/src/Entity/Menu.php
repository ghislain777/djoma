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
 *  * * @ApiResource(
  *   normalizationContext={"groups"={"lecture"}},
  *     denormalizationContext={"groups"={"ecriture"}},
  *     attributes={
  *         "pagination_client_items_per_page"=true,
  *         "order"={"id": "asc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *  @Groups({"lecture"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false, options={"comment"="Nom"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true, options={"comment"="Description"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="menu")
     */
    private $activites;

    /**
     * @ORM\Column(type="string", length=255, options={"comment"="Icone"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $icone;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
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

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setMenu($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getMenu() === $this) {
                $activite->setMenu(null);
            }
        }

        return $this;
    }

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(string $icone): self
    {
        $this->icone = $icone;

        return $this;
    }


}
