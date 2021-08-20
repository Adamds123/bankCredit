<?php

namespace App\Account\Entity;

class UserEntity
{
    private $id;
    private  $name;
    private $lastName;
    private  $email;
    private $password;
    private  $numberOfChild;
    private  $salary;
    private  $dette;
    private $relevet;
    private $garantie;
    private  $role;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getNumberOfChild(): int
    {
        return $this->numberOfChild;
    }

    /**
     * @param int $numberOfChild
     */
    public function setNumberOfChild(int $numberOfChild): void
    {
        $this->numberOfChild = $numberOfChild;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     */
    public function setSalary(int $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getDette(): int
    {
        return $this->dette;
    }

    /**
     * @param int $dette
     */
    public function setDette(int $dette): void
    {
        $this->dette = $dette;
    }

    /**
     * @return string
     */
    public function getRelevet(): string
    {
        return $this->relevet;
    }

    /**
     * @param string $relevet
     */
    public function setRelevet(string $relevet): void
    {
        $this->relevet = $relevet;
    }

    /**
     * @return string|null
     */
    public function getGarantie(): ?string
    {
        return $this->garantie;
    }

    /**
     * @param string $garantie
     */
    public function setGarantie(string $garantie): void
    {
        $this->garantie = $garantie;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getRole() : ?string
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

}