<?php

namespace Location\Model;

use Core\Model\SimpleEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class City
 * 
 * @ORM\Entity
 * @ORM\Table(name="lc_city")
 *
 * @author Petr Blazicek 2016
 */
class City extends SimpleEntity
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


	public function __construct( $name )
	{
		$this->setName( $name );
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


}
