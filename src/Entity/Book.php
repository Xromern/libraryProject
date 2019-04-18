<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=1200, nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    public $number_pages;
    /**
     * @ORM\Column(type="date", nullable=false)
     */
    public $date;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Image()
     */
    private $cover;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $book_pdf;

    /**
     * @ORM\ManyToOne(targetEntity="Writer")
     */
    private $writer;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(name="genres_list")
     */
    private $genres;

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres): void
    {
        $this->genres = $genres;
    }

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): self
    {
        $this->title = $title;
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
    public function getCover(): ?string
    {
        return $this->cover;
    }
    public function setCover(?string $cover): self
    {
        $this->cover = $cover;
        return $this;
    }
    public function get_number_pages()
    {
        return $this->id;
    }
    public function set_number_pages($number_pages)
    {
        $this->number_pages = (int)$number_pages;
        return $this;
    }
    public function getWriter(): ?Writer
    {
        return $this->writer;
    }
    public function setWriter($writer): self
    {
        $this->writer = $writer;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
    /**
     * @return mixed
     */
    public function getBookPdf()
    {
        return $this->book_pdf;
    }
    /**
     * @param mixed $book_pdf
     */
    public function setBookPdf($book_pdf): void
    {
        $this->book_pdf = $book_pdf;

    }
    public function __toString()
    {
        return (String)$this->title;
    }

}