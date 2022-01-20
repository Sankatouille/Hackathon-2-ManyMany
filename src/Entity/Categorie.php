<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(targetEntity: Piece::class, mappedBy: 'categorie')]
    private $pieces;

    #[ORM\ManyToMany(targetEntity: SousCategorie::class, inversedBy: 'categories')]
    private $sousCategorie;

    public function __construct()
    {
        $this->pieces = new ArrayCollection();
        $this->sousCategorie = new ArrayCollection();
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

    /**
     * @return Collection|Piece[]
     */
    public function getPieces(): Collection
    {
        return $this->pieces;
    }

    public function addPiece(Piece $piece): self
    {
        if (!$this->pieces->contains($piece)) {
            $this->pieces[] = $piece;
            $piece->addCategorie($this);
        }

        return $this;
    }

    public function removePiece(Piece $piece): self
    {
        if ($this->pieces->removeElement($piece)) {
            $piece->removeCategorie($this);
        }

        return $this;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sousCategorie;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie[] = $sousCategorie;
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        $this->sousCategorie->removeElement($sousCategorie);

        return $this;
    }
}
