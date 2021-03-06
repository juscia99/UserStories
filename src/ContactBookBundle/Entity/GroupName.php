<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GroupName
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ContactBookBundle\Entity\GroupNameRepository")
 */
class GroupName
{
    
     /**
     * @ORM\ManyToMany(targetEntity="Contact", mappedBy="groups")
     */
    private $contacts;

    public function __construct() {
        $this->contacts = new ArrayCollection();
    }
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=60)
     */
    private $type;


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
     * Set type
     *
     * @param string $type
     * @return GroupName
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add contacts
     *
     * @param \ContactBookBundle\Entity\Contact $contacts
     * @return GroupName
     */
    public function addContact(\ContactBookBundle\Entity\Contact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \ContactBookBundle\Entity\Contact $contacts
     */
    public function removeContact(\ContactBookBundle\Entity\Contact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
