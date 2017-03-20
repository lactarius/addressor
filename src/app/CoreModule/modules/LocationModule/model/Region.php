<?php

namespace Location\Model;

use Core\Model\SimpleEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Region
 *
 * @ORM\Entity
 * @ORM\Table(name="lc_region", options={"collate"="utf8_czech_ci"})
 * 
 * @author Petr Blazicek 2016
 */
class Region extends SimpleEntity
{

	/**
	 * @ORM\Column(length=32, unique=true)
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(length=32, nullable=true)
	 * @var string
	 */
	private $nameEng;

	/**
	 * @ORM\ManyToOne(targetEntity="Country", fetch="LAZY")
	 * @var Country
	 */
	private $country;


	public function __construct( $name, Country $country )
	{
		$this->setName( $name )->setCountry( $country );
	}


	// getters & setters

	public function getName()
	{
		return $this->name;
	}


	public function setName( $name )
	{
		$this->name = $name;
		return $this;
	}


	public function getNameEng()
	{
		return $this->nameEng;
	}


	public function setNameEng( $nameEng )
	{
		$this->nameEng = $nameEng;
		return $this;
	}


	public function getCountry()
	{
		return $this->country;
	}


	public function setCountry( Country $country )
	{
		$this->country = $country;
		return $this;
	}


}
