<?php

namespace POL\CarnetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeContact
 *
 * @ORM\Table(name="liste_contact")
 * @ORM\Entity(repositoryClass="POL\CarnetBundle\Entity\ListeContactRepository")
 */
class ListeContact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="POL\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="username_id", referencedColumnName="id")
     */
    protected $usernameId;

    /**
    * @ORM\ManyToOne(targetEntity="POL\UserBundle\Entity\User")
    * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    protected $contactId;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usernameId
     *
     * @param integer $usernameId
     * @return ListeContact
     */
    public function setUsernameId($usernameId)
    {
        $this->usernameId = $usernameId;

        return $this;
    }

    /**
     * Get usernameId
     *
     * @return integer
     */
    public function getUsernameId()
    {
        return $this->usernameId;
    }

    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return ListeContact
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer
     */
    public function getContactId()
    {
        return $this->contactId;
    }
}
