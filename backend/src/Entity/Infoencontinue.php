<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InfoencontinueRepository;
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
 * @ORM\Entity(repositoryClass=InfoencontinueRepository::class)
 */
class Infoencontinue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"comment":"ID"})
     *  @Groups({"lecture"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Titre"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=900, nullable=true, options={"comment":"Commentaire"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Type de contenu"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $typedecontenu;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"comment":"Date de l info"})
     *  @Groups({"lecture", "ecriture"})
     */
    private $datedelinfo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getTypedecontenu(): ?string
    {
        return $this->typedecontenu;
    }

    public function setTypedecontenu(string $typedecontenu): self
    {
        $this->typedecontenu = $typedecontenu;

        return $this;
    }

    public function getDatedelinfo(): ?\DateTimeInterface
    {
        return $this->datedelinfo;
    }

    public function setDatedelinfo(?\DateTimeInterface $datedelinfo): self
    {
        $this->datedelinfo = $datedelinfo;

        return $this;
    }


}
