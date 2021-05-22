<?php

namespace App\Entity;

use App\Repository\SubjectEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectEntityRepository::class)
 */
class SubjectEntity
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
    private $subjectName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passingGrade;

    /**
     * @ORM\ManyToOne(targetEntity=CollegeEntity::class)
     */
    private $college;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectName(): ?string
    {
        return $this->subjectName;
    }

    public function setSubjectName(?string $subjectName): self
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    public function getPassingGrade(): ?int
    {
        return $this->passingGrade;
    }

    public function setPassingGrade(?int $passingGrade): self
    {
        $this->passingGrade = $passingGrade;

        return $this;
    }

    public function getCollege(): ?CollegeEntity
    {
        return $this->college;
    }

    public function setCollege(?CollegeEntity $college): self
    {
        $this->college = $college;

        return $this;
    }
}
