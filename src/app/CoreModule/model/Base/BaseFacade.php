<?php

namespace Core\Model;

use Kdyby\Doctrine\EntityManager;


/**
 * Class BaseFacade
 * 
 * Project facades predecessor
 * 
 * Common methods:
 * 
 * - prepareEntity
 * - saveAll
 * 
 * M!	- slightly magic
 * M!!	- medium magic
 * M!!!	- strongly magic
 *
 * @author Petr Blazicek 2016
 */
class BaseFacade extends \Nette\Object
{

	const BASE_ENTITY = '\Core\Model\SimpleEntity';


	/** @var EntityManager */
	protected $em;


	public function __construct( EntityManager $em )
	{
		$this->em = $em;
	}


	/**
	 * Returns existing or new entity (M!)
	 * 
	 * @param mixed $class
	 * @param array|Traversable $data
	 * @return mixed
	 */
	protected function prepareEntity( $class, $data )
	{
		$id = isset( $data[ 'id' ] ) && $data[ 'id' ] ? $data[ 'id' ] : NULL;
		return $id ? $this->em->find( $class, $id ) : new $class;
	}


	/**
	 * Persist given entity(ies) (M!)
	 * if needed
	 * 
	 * @param mixed|mixed[] $group
	 * @param bool $flush
	 * @return self (fluent interface)
	 */
	protected function saveAll( $group, $flush = TRUE )
	{
		if ( !is_array( $group ) ) {
			$group = [ $group ];
		}

		foreach ( $group as $entity ) {
			if ( is_subclass_of( $entity, self::BASE_ENTITY ) && !$entity->id ) {
				$this->em->persist( $entity );
			}
		}

		if ( $flush ) {
			$this->em->flush();
		}

		return $this;
	}


	/**
	 * Returns browser first language
	 * 
	 * @return string
	 */
	protected function getPreferredLanguage()
	{
		$languages = explode( ',', $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] );
		return $languages[ 0 ];
	}


	// getters & setters

	public function getEm()
	{
		return $this->em;
	}


}
