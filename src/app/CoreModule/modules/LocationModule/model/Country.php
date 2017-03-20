<?php

namespace Location\Model;

use Core\Model\SimpleEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Country
 *
 * @ORM\Entity
 * @ORM\Table(name="lc_country", options={"collate"="utf8_czech_ci"})
 * 
 * @author Petr Blazicek 2016
 */
class Country extends SimpleEntity
{

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $codeNum;

	/**
	 * @ORM\Column(length=2)
	 * @var string
	 */
	private $codeAlpha2;

	/**
	 * @ORM\Column(length=3)
	 * @var string
	 */
	private $codeAlpha3;

	/**
	 * @ORM\Column(length=64)
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(length=32)
	 * @var string
	 */
	private $nameShort;

	/**
	 * @ORM\Column(length=64)
	 * @var string
	 */
	private $nameEng;

	/**
	 * @ORM\Column(length=32)
	 * @var string
	 */
	private $nameEngShort;


	// getters & setters

	public function getCodeNum()
	{
		return $this->codeNum;
	}


	public function getCodeAlpha2()
	{
		return $this->codeAlpha2;
	}


	public function getCodeAlpha3()
	{
		return $this->codeAlpha3;
	}


	public function getName()
	{
		return $this->name;
	}


	public function getNameShort()
	{
		return $this->nameShort;
	}


	public function getNameEng()
	{
		return $this->nameEng;
	}


	public function getNameEngShort()
	{
		return $this->nameEngShort;
	}


	public function setCodeNum( $codeNum )
	{
		$this->codeNum = $codeNum;
		return $this;
	}


	public function setCodeAlpha2( $codeAlpha2 )
	{
		$this->codeAlpha2 = $codeAlpha2;
		return $this;
	}


	public function setCodeAlpha3( $codeAlpha3 )
	{
		$this->codeAlpha3 = $codeAlpha3;
		return $this;
	}


	public function setName( $name )
	{
		$this->name = $name;
		return $this;
	}


	public function setNameShort( $nameShort )
	{
		$this->nameShort = $nameShort;
		return $this;
	}


	public function setNameEng( $nameEng )
	{
		$this->nameEng = $nameEng;
		return $this;
	}


	public function setNameEngShort( $nameEngShort )
	{
		$this->nameEngShort = $nameEngShort;
		return $this;
	}


}
