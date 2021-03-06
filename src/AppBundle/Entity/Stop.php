<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Article;
use AppBundle\Entity\Waypoint;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StopRepository")
 */
class Stop
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
	* @var string
	*
	* @Gedmo\Slug(fields={"title"})
	* @ORM\Column(type="string")
	*/
	private $slug;

	/**
	* @var string
	*
	* @ORM\Column(type="string", nullable=true)
	*/
	private $title;

	/**
	* @var string
	*
	* @ORM\Column(type="string", nullable=true)
	*/
	private $description;

	/**
	* @var string
	*
	* @ORM\Column(type="string")
	*/
	private $lat;

	/**
	* @var string
	*
	* @ORM\Column(type="string")
	*/
	private $lon;

	/**
	* @var string
	*
	* @ORM\Column(type="string")
	*/
	private $address;

    /**
     * @ORM\ManyToMany(targetEntity="Waypoint", cascade={"persist", "remove"})
     */
    protected $waypoint;

	/**
     * @ORM\ManyToOne(targetEntity="Roadtrip", inversedBy="stops")
     * @ORM\JoinColumn(name="roadTripStop", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $roadTripStop;

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
     * Set slug
     *
     * @param string $slug
     *
     * @return Roadtrip
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Roadtrip
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Roadtrip
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Roadtrip
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set isRemoved
     *
     * @param boolean $isRemoved
     *
     * @return Roadtrip
     */
    public function setIsRemoved($isRemoved)
    {
        $this->isRemoved = $isRemoved;

        return $this;
    }

    /**
     * Get isRemoved
     *
     * @return boolean
     */
    public function getIsRemoved()
    {
        return $this->isRemoved;
    }

    /**
     * Set lat
     *
     * @param array $lat
     *
     * @return Roadtrip
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return array
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param array $lon
     *
     * @return Roadtrip
     */
    public function setlon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return array
     */
    public function getlon()
    {
        return $this->lon;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return Roadtrip
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set address
     *
     * @param array $address
     *
     * @return Roadtrip
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return array
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->waypoint = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add waypoint
     *
     * @param \AppBundle\Entity\Waypoint $waypoint
     *
     * @return Stop
     */
    public function addWaypoint(\AppBundle\Entity\Waypoint $waypoint)
    {
        $this->waypoint[] = $waypoint;

        return $this;
    }

    /**
     * Remove waypoint
     *
     * @param \AppBundle\Entity\Waypoint $waypoint
     */
    public function removeWaypoint(\AppBundle\Entity\Waypoint $waypoint)
    {
        $this->waypoint->removeElement($waypoint);
    }

    /**
     * Get waypoint
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWaypoint()
    {
        return $this->waypoint;
    }

    /**
     * Set roadTripStop
     *
     * @param \AppBundle\Entity\Roadtrip $roadTripStop
     *
     * @return Stop
     */
    public function setRoadTripStop(\AppBundle\Entity\Roadtrip $roadTripStop = null)
    {
        $this->roadTripStop = $roadTripStop;

        return $this;
    }

    /**
     * Get roadTripStop
     *
     * @return \AppBundle\Entity\Roadtrip
     */
    public function getRoadTripStop()
    {
        return $this->roadTripStop;
    }
}
