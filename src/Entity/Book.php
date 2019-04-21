<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 * @Vich\Uploadable
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
    private $number_pages;

    /**
     * @return mixed
     */
    public function getNumberPages()
    {
        return $this->number_pages;
    }

    /**
     * @param mixed $number_pages
     */
    public function setNumberPages($number_pages): void
    {
        $this->number_pages = $number_pages;
    }
    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $date;


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
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param string $pdf
     */
    public function setPdf( $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return File
     */
    public function getPdfFile()
    {
        return $this->pdfFile;
    }

    /**
     * @param File $pdfFile
     */
    public function setPdfFile(File $pdfFile = null)
    {
        $this->pdfFile = $pdfFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($pdfFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @var string
     */
    private $pdf;

    /**
     * @Vich\UploadableField(mapping="book_pdf", fileNameProperty="pdf")
     * @var File
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $pdfFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="cover_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    // ...

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

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


    public function __toString()
    {
        return (String)$this->title;
    }

}