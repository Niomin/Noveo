<?php

namespace AppBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 */
class User implements JsonSerializable
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
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetimetz")
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

    function jsonSerialize()
    {
        return [
            'id'         => $this->id,
            'email'      => $this->email,
            'firstName'  => $this->firstName,
            'lastName'   => $this->lastName,
            'state'      => $this->state,
            'group'      => $this->group,
            'dateCreate' => $this->dateCreate,
        ];
    }
}