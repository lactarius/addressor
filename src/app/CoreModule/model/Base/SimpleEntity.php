<?php

namespace Core\Model;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\Strings;
use Nette\Object;


/**
 * Class SimpleEntity
 * Entity ancestor
 *
 * - Identified
 *
 * @ORM\MappedSuperclass
 *
 * Petr Blažíček 2016
 */
abstract class SimpleEntity extends Object
{
	use MapperTrait;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var int
	 */
	protected $id;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}


	// internal routines

	/**
	 * Corrects input string
	 * 
	 * @param mixed $value
	 * @return string
	 */
	protected function cleanString($value){
		return Strings::normalize($value);
	}
}
