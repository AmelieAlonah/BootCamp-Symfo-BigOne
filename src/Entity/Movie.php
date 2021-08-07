<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("movies_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=211, unique=true)
     * 
     * @Assert\NotBlank
     * @Assert\Length(max=211)
     * 
     * @Groups("movies_get")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="movies")
     * @ORM\OrderBy({"name"="ASC"})
     * 
     * @Assert\Count(min=1)
     * 
     * @Groups("movies_get")
     */
    private $genres;

    /**
     * @ORM\OneToMany(targetEntity=Casting::class, mappedBy="movie", cascade={"remove"})
     * @ORM\OrderBy({"creditOrder"="ASC"})
     * 
     * @Groups("movies_get")
     */
    private $casting;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="movie", orphanRemoval=true)
     */
    private $reviews;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Assert\NotBlank
     * 
     * @Groups("movies_get")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="smallint")
     * 
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\LessThanOrEqual(1440)
     * 
     * @Groups("movies_get")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("movies_get")
     */
    private $poster;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * 
     * @Assert\NotBlank
     * @Assert\Type("int") 
     * @Assert\Length(max = 1)
     * @Assert\Choice({5, 4, 3, 2, 1}) 
     * 
     * @Groups({"movies_get"})
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=211, unique=true)
     * 
     * @Groups("movies_get")
     */
    private $slug;

    /**
     * Defaults values
     */
    public function __construct()
    {
        $this->createdAt    = new DateTime();
        $this->releaseDate  = new DateTime();
        $this->genres       = new ArrayCollection();
        $this->castings     = new ArrayCollection();
        $this->reviews      = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getCasting(): ?string
    {
        return $this->casting;
    }

    public function setCasting(string $casting): self
    {
        $this->casting = $casting;

        return $this;
    }

    public function getReviews(): ?string
    {
        return $this->reviews;
    }

    public function setReviews(string $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
