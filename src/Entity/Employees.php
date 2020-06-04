<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeesRepository::class)
 */
class Employees
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;



    /**
     * @ORM\OneToMany(targetEntity=Salaries::class, mappedBy="emp_id")
     */
    private $salaries;

    /**
     * @ORM\Column(type="date")
     */
    private $birth_date;

    /**
     * @ORM\Column(type="date")
     */
    private $hire_date;

    /**
     * @ORM\OneToMany(targetEntity=Departments::class, mappedBy="employees")
     */
    private $Department;




    public function __construct()
    {
        $this->salaries = new ArrayCollection();
        $this->Department = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }



    /**
     * @return Collection|Salaries[]
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(Salaries $salary): self
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries[] = $salary;
            $salary->setEmpId($this);
        }

        return $this;
    }

    public function removeSalary(Salaries $salary): self
    {
        if ($this->salaries->contains($salary)) {
            $this->salaries->removeElement($salary);
            // set the owning side to null (unless already changed)
            if ($salary->getEmpId() === $this) {
                $salary->setEmpId(null);
            }
        }

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hire_date;
    }

    public function setHireDate(\DateTimeInterface $hire_date): self
    {
        $this->hire_date = $hire_date;

        return $this;
    }

    /**
     * @return Collection|Departments[]
     */
    public function getDepartment(): Collection
    {
        return $this->Department;
    }

    public function addDepartment(Departments $department): self
    {
        if (!$this->Department->contains($department)) {
            $this->Department[] = $department;
            $department->setEmployees($this);
        }

        return $this;
    }

    public function removeDepartment(Departments $department): self
    {
        if ($this->Department->contains($department)) {
            $this->Department->removeElement($department);
            // set the owning side to null (unless already changed)
            if ($department->getEmployees() === $this) {
                $department->setEmployees(null);
            }
        }

        return $this;
    }




}
