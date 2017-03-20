<?php

namespace Core\Model;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\DateTime;


/**
 * Class RichEntity
 *
 * @ORM\MappedSuperclass
 *
 * Petr Blažíček 2016
 */
abstract class RichEntity extends CommonEntity
{
	/**
	 * @ORM\Column(type="datetimetz", nullable=true)
	 * @var DateTime
	 */
	protected $deleted;

	/**
	 * @return DateTime
	 */
	public function getDeleted()
	{
		return $this->deleted;
	}

	public function isActive()
	{
		return $this->deleted === NULL;
	}

	/**
	 * @param DateTime $deleted
	 * @return self (fluent interface)
	 */
	public function setDeleted( $deleted )
	{
		$this->deleted = $deleted;
		return $this;
	}

	/**
	 * @return self (fluent interface)
	 */
	public function delete()
	{
		$this->deleted = new DateTime();
		return $this;
	}

	/**
	 * @return self (fluent interface)
	 */
	public function unDelete()
	{
		$this->deleted = NULL;
		return $this;
	}
}
