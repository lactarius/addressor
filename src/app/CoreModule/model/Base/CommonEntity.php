<?php

namespace Core\Model;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\DateTime;


/**
 * File CommonEntity
 * Entity ancestor
 *
 * - Identified
 * - Timestamped
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 *
 * Petr Blažíček 2016
 */
abstract class CommonEntity extends SimpleEntity
{
	/**
	 * @ORM\Column(type="datetimetz")
	 * @var DateTime
	 */
	protected $created;

	/**
	 * @ORM\Column(type="datetimetz")
	 * @var DateTime
	 */
	protected $updated;

	/**
	 * @return DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @ORM\PrePersist
	 */
	public function prePersist()
	{
		$this->updated = $this->created = new DateTime();
	}

	/**
	 * @return DateTime
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * @ORM\PreUpdate
	 */
	public function preUpdate()
	{
		$this->updated = new DateTime();
	}
}
