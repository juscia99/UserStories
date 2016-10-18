<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contact
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ContactBookBundle\Entity\ContactRepository")
 */


class Contact
{
    
    /**
     * @ORM\ManyToMany(targetEntity="Phone")
     * @ORM\JoinTable(name="contacts_phoneNumbers",
     *      joinColumns={@ORM\JoinColumn(name="contact_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="phone_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $phoneNumbers;
    
    /**
     * @ORM\ManyToMany(targetEntity="Email")
     * @ORM\JoinTable(name="contacts_emails",
     *      joinColumns={@ORM\JoinColumn(name="contact_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="email_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $emails;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="GroupName", inversedBy="contacts")
     * @ORM\JoinTable(name="contacts_groups")
     */
    private $groups;

    public function __construct() {
        $this->groups = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;
    
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
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=60)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set name
     *
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add groups
     *
     * @param \ContactBookBundle\Entity\GroupName $groups
     * @return Contact
     */
    public function addGroup(\ContactBookBundle\Entity\GroupName $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \ContactBookBundle\Entity\GroupName $groups
     */
    public function removeGroup(\ContactBookBundle\Entity\GroupName $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set address
     *
     * @param \ContactBookBundle\Entity\Address $address
     * @return Contact
     */
    public function setAddress(\ContactBookBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \ContactBookBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add phoneNumbers
     *
     * @param \ContactBookBundle\Entity\Phone $phoneNumbers
     * @return Contact
     */
    public function addPhoneNumber(\ContactBookBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers[] = $phoneNumbers;

        return $this;
    }

    /**
     * Remove phoneNumbers
     *
     * @param \ContactBookBundle\Entity\Phone $phoneNumbers
     */
    public function removePhoneNumber(\ContactBookBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers->removeElement($phoneNumbers);
    }

    /**
     * Get phoneNumbers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Add emails
     *
     * @param \ContactBookBundle\Entity\Email $emails
     * @return Contact
     */
    public function addEmail(\ContactBookBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \ContactBookBundle\Entity\Email $emails
     */
    public function removeEmail(\ContactBookBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
