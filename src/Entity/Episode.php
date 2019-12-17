<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EpisodeRepository")
 */
class Episode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return Episode
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

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
    public function getSummary(): ?string
    {
        return $this->summary;
    }
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }
    public function getSeason(): ?Season
    {
        return $this->season;
    }
    public function setSeason(?Season $season): self
    {
        $this->season = $season;
        return $this;
    }
}
