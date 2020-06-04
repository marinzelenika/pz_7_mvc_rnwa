<?php

namespace App\Entity;

use App\Repository\SalariesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalariesRepository::class)
 */
class Salaries
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $salary;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fromdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $todate;

    /**
     * @ORM\ManyToOne(targetEntity=Employees::class, inversedBy="salaries")
     */
    private $emp_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getFromdate(): ?\DateTimeInterface
    {
        return $this->fromdate;
    }

    public function setFromdate(\DateTimeInterface $fromdate): self
    {
        $this->fromdate = $fromdate;

        return $this;
    }

    public function getTodate(): ?\DateTimeInterface
    {
        return $this->todate;
    }

    public function setTodate(\DateTimeInterface $todate): self
    {
        $this->todate = $todate;

        return $this;
    }

    public function getEmpId(): ?Employees
    {
        return $this->emp_id;
    }

    public function setEmpId(?Employees $emp_id): self
    {
        $this->emp_id = $emp_id;

        return $this;
    }
}
