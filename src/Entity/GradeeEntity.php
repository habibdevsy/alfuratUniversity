<?php

namespace App\Entity;

use App\Repository\GradeeEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=GradeeEntityRepository::class)
 */
class GradeeEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $grade;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $passedFiled;

    /**
     * @ORM\ManyToOne(targetEntity=UserEntity::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date", nullable=true)
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity=SubjectEntity::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(?float $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getPassedFiled(): ?bool
    {
        return $this->passedFiled;
    }

    public function setPassedFiled(?bool $passedFiled): self
    {
        $this->passedFiled = $passedFiled;

        return $this;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getSubject(): ?SubjectEntity
    {
        return $this->Subject;
    }

    public function setSubject(?SubjectEntity $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }
}
