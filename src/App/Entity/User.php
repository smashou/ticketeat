<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Customer
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="users")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id", nullable=true)
     */
    protected $customer;


    /**
     * @return customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param customer
     * @return customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

}