<?php

namespace App\Entity;

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
  *         "order"={"id": "asc"}
  *     }
  * )
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "nom": "partial", "description": "partial"})
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity
 */
class Activite
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
     * @var string|null
     *
     * @ORM\Column(name="chemain", type="string", length=255, nullable=true, options={"comment"="Chemain"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $chemain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment"="Icone", "default"="store"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $icone;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="activites")
     * @ORM\JoinColumn(nullable=true, name="menu", referencedColumnName="id")
     *  @Groups({"lecture", "ecriture"})
     */
    private $menu;

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

    public function getChemain(): ?string
    {
        return $this->chemain;
    }

    public function setChemain(?string $chemain): self
    {
        $this->chemain = $chemain;

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

    public function getMenu(): ?menu
    {
        return $this->menu;
    }

    public function setMenu(?menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }


}
