<?php

namespace Location\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Area
 *
 * @ORM\Entity
 * @ORM\Table(name="lc_area", options={"collate"="utf8_czech_ci"})
 * 
 * @author Petr Blazicek 2016
 */
class Area extends \Core\Model\SimpleEntity
{

	/**
	 * @ORM\ManyToOne(targetEntity="Region", cascade={"all"}, fetch="LAZY")
	 * @var Region
	 */
	private $region;

	/**
	 * @ORM\ManyToOne(targetEntity="City", cascade={"all"}, fetch="LAZY")
	 * @var City
	 */
	private $city;

	/**
	 * @ORM\ManyToOne(targetEntity="Postal", cascade={"all"}, fetch="LAZY")
	 * @var Postal
	 */
	private $postal;

	/**
	 * @ORM\ManyToOne(targetEntity="District", cascade={"all"}, fetch="LAZY")
	 * @var District
	 */
	private $district;

	/**
	 * @ORM\ManyToOne(targetEntity="Part", cascade={"all"}, fetch="LAZY")
	 * @var Part
	 */
	private $part;

	/**
	 * @ORM\ManyToOne(targetEntity="Street", cascade={"all"}, fetch="LAZY")
	 * @var Street
	 */
	private $street;


	// getters & setters

	public function getRegion()
	{
		return $this->region;
	}


	public function setRegion( Region $region )
	{
		$this->region = $region;
		return $this;
	}


	public function getCity()
	{
		return $this->city;
	}


	public function setCity( City $city )
	{
		$this->city = $city;
		return $this;
	}


	public function getPostal()
	{
		return $this->postal;
	}


	public function setPostal( Postal $postal = NULL )
	{
		$this->postal = $postal;
		return $this;
	}


	public function getDistrict()
	{
		return $this->district;
	}


	public function setDistrict( District $district = NULL )
	{
		$this->district = $district;
		return $this;
	}


	public function getPart()
	{
		return $this->part;
	}


	public function setPart( Part $part = NULL )
	{
		$this->part = $part;
		return $this;
	}


	public function getStreet()
	{
		return $this->street;
	}


	public function setStreet( Street $street = NULL )
	{
		$this->street = $street;
		return $this;
	}


}
