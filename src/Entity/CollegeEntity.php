<?php

namespace App\Entity;

use App\Repository\CollegeEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeEntityRepository::class)
 */
class CollegeEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $collegeName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $collegeCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollegeCode(): ?string
    {
        return $this->collegeCode;
    }

    public function setCollegeCode(?string $collegeCode): self
    {
        $this->collegeCode = $collegeCode;

        return $this;
    }

    public function getCollegeName(): ?string
    {
        return $this->collegeName;
    }

    public function setCollegeName(?string $collegeName): self
    {
        $this->collegeName = $collegeName;

        return $this;
    }
}
