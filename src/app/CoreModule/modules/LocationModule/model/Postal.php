<?php

namespace Location\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Postal
 *
 * @ORM\Entity
 * @ORM\Table(name="lc_postal", options={"collate"="utf8_czech_ci"})
 * 
 * @author Petr Blazicek 2016
 */
class Postal extends \Core\Model\SimpleEntity
{

	/**
	 * @ORM\Column(length=8)
	 * @var string
	 */
	private $code;

	/**
	 * @ORM\Column(length=64, nullable=true)
	 * @var string
	 */
	private $name;


	public function __construct( $code )
	{
		$this->setCode( $code );
	}


	// getters & setters

	public function getCode()
	{
		return $this->code;
	}


	public function setCode( $code )
	{
		$this->code = $code;
		return $this;
	}


	public function getName()
	{
		return $this->name;
	}


	public function setName( $name )
	{
		$this->name = $name;
		return $this;
	}


}
