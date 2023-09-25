<?php

namespace App\Entity;

use Vich\Uploadable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\AnnotationInterface as Vich;

#[ORM\Entity(repositoryClass: VisiteRepository::class)]
#[Uploadable]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datecreation = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $avis = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsmin = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsmax = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;

    /**
     * @Vich\UploadableField(mapping="visites", FileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $imageName;
    
    #[ORM\ManyToMany(targetEntity: Environnement::class)]
    private Collection $environnements;

    public function __construct()
    {
        $this->environnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): static
    {
        $this->avis = $avis;

        return $this;
    }

    public function getTempsmin(): ?int
    {
        return $this->tempsmin;
    }

    public function setTempsmin(?int $tempsmin): static
    {
        $this->tempsmin = $tempsmin;

        return $this;
    }

    public function getTempsmax(): ?int
    {
        return $this->tempsmax;
    }

    public function setTempsmax(?int $tempsmax): static
    {
        $this->tempsmax = $tempsmax;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDatecreationString() : string{
        if($this->datecreation == null){
            return "";
        }
        else{
            return $this->datecreation->format('d/m/Y');
        }
    }

    /**
     * @return Collection<int, Environnement>
     */
    public function getEnvironnements(): Collection
    {
        return $this->environnements;
    }

    public function addEnvironnement(Environnement $environnement): static
    {
        if (!$this->environnements->contains($environnement)) {
            $this->environnements->add($environnement);
        }

        return $this;
    }

    public function removeEnvironnement(Environnement $environnement): static
    {
        $this->environnements->removeElement($environnement);

        return $this;
    }

	/**
	 * 
	 * @return File|null
	 */
	public function getImageFile() {
		return $this->imageFile;
	}
	
	/**
	 * 
	 * @param File|null $imageFile 
	 * @return self
	 */
	public function setImageFile($imageFile): self {
		$this->imageFile = $imageFile;
		return $this;
	}

	/**
	 * 
	 * @return string|null
	 */
	public function getImageName() {
		return $this->imageName;
	}
	
	/**
	 * 
	 * @param string|null $imageName 
	 * @return self
	 */
	public function setImageName($imageName): self {
		$this->imageName = $imageName;
		return $this;
	}
}
