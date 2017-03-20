<?php

namespace Core\Model\Traits;

use Doctrine\ORM\Mapping as ORM;


/**
 * Trait IdentifierTrait
 * 
 * Entity ID column
 *
 * @property-read int $id
 */
trait IdentifierTrait
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="bigint")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 * @var int
	 */
	private $id;


	/**
	 * @return int
	 */
	final public function getId()
	{
		return $this->id;
	}

}
