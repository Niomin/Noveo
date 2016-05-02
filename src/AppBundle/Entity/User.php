<?php

namespace AppBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="email")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var bool
     * @ORM\Column(type="bool")
     */
    private $state;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="dateCreate")
     */
    private $dateCreate;

    /**
     * @var Group
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group")
     */
    private $group;

    public function __construct()
    {
        $this->dateCreate = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return boolean
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param boolean $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param Group $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

}