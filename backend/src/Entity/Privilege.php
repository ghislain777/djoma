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
  * @ApiFilter(SearchFilter::class, properties={"id": "exact", "role": "exact", "nom": "partial", "description": "partial"})
 * Privilege
 *
 * @ORM\Table(name="privilege", indexes={@ORM\Index(name="IDX_87209A8757698A6A", columns={"role"}), @ORM\Index(name="IDX_87209A87B8755515", columns={"activite"})})
 * @ORM\Entity
 */
class Privilege
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
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"comment"="Actif?"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $actif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true, options={"comment"="Description"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $description;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id")
     * })
     *  @Groups({"lecture", "ecriture"})
     */
    private $role;

    /**
     * @var \Activite
     *
     * @ORM\ManyToOne(targetEntity="Activite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="activite", referencedColumnName="id")
     * })
     *  @Groups({"lecture", "ecriture"})
     */
    private $activite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): self
    {
        $this->activite = $activite;

        return $this;
    }


}
