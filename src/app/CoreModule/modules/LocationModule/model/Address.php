<?php

namespace Location\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Address
 *
 * @ORM\Entity
 * @ORM\Table(name="lc_address", options={"collate"="utf8_czech_ci"})
 * 
 * @author Petr Blazicek 2016
 */
class Address extends \Core\Model\SimpleEntity
{

	/**
	 * @ORM\Column(length=8, nullable=true)
	 * @var string
	 */
	private $regNr;

	/**
	 * @ORM\Column(length=8, nullable=true)
	 * @var string
	 */
	private $houseNr;

	/**
	 * @ORM\ManyToOne(targetEntity="Area", cascade={"all"}, fetch="LAZY")
	 * @var Area
	 */
	private $area;


	public function __construct( Area $area, $regNr, $houseNr = NULL )
	{
		$this->setArea( $area )->setRegNr( $regNr )->setHouseNr( $houseNr );
	}


	// getters & setters

	public function getRegNr()
	{
		return $this->regNr;
	}


	public function setRegNr( $regNr )
	{
		$this->regNr = $regNr;
		return $this;
	}


	public function getHouseNr()
	{
		return $this->houseNr;
	}


	public function setHouseNr( $houseNr )
	{
		$this->houseNr = $houseNr;
		return $this;
	}


	public function getArea()
	{
		return $this->area;
	}


	public function setArea( Area $area )
	{
		$this->area = $area;
		return $this;
	}


}
