<?php

namespace Core\Model;

use Nette\Reflection\ClassType;
use Nette\Utils\Strings;


/**
 * File MapperTrait
 * 
 * Universal data import / export routines
 * 
 * Methods
 * 
 * - draw
 * - map
 *
 * Petr Blažíček 2016
 */
trait MapperTrait
{


	/**
	 * Fills entity properties	(M!!)
	 * from given data
	 *
	 * @param mixed $data[]
	 * @return self (fluent interface)
	 * @throws InvalidArgumentException
	 */
	public function draw( $data )
	{
		/* @var $objectReflection ClassType */
		$objectReflection = $this->getReflection();

		// check Entity class annotation first
		if ( !$objectReflection->hasAnnotation( 'ORM\Entity' ) ) {
			throw new InvalidArgumentException( "I am something completely different than a Doctrine entity." );
		}

		// check data usability
		if ( !is_array( $data ) && !$data instanceof \Traversable ) {
			throw new InvalidArgumentException( "Given data is not an array nor traversable type." );
		}

		foreach ( $data as $propertyName => $value ) {
			// property has a setter => it should be publicly accessible
			if ( $objectReflection->hasMethod( 'set' . Strings::firstUpper( $propertyName ) ) ) {
				$this->$propertyName = $value;
			}
		}

		//@TODO Don't believe this magic :-)

		foreach ( $data as $property => $value ) {
			$this->$property = $value;
		}

		return $this;
	}


	/**
	 * Pumps accessible entity data
	 * into an array
	 *
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function map()
	{
		if ( !ClassUtils::getClass( $this ) ) {
			throw new InvalidArgumentException( "I am not a Doctrine entity." );
		}

		$data = [ ];

		$reflection = $this->reflection;
		foreach ( $reflection->getProperties() as $property ) {
			$propertyname = $property->getName();
			// only property with getter is accessible
			$methodname = 'get' . Strings::firstUpper( $propertyname );
			if ( $reflection->hasMethod( $methodname ) ) {
				$method = $reflection->getMethod( $methodname );
				if ( $method->isPublic() && !$property->isStatic() ) {
					$data[ $propertyname ] = $this->$propertyname;
				}
			}
		}

		return $data;
	}

}
