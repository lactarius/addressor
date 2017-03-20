<?php

use Location\Model\LocationFacade;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


/**
 * Test Class LocationTest
 *
 * @author Petr Blazicek 2016
 */
class LocationTest extends Tester\TestCase
{

	/** @var Nette\DI\Container */
	private $container;

	/** @var LocationFacade */
	private $fcd;


	function __construct( Nette\DI\Container $container )
	{
		$this->container = $container;
		$this->fcd = $container->getByType( LocationFacade::class );
	}


	function testGetCountry()
	{
		$c = $this->fcd->getCountry( 'CZ' );

		Assert::same( 'the Czech Republic', $c->getNameEng() );
	}


	function testGetRegion()
	{
		$r = $this->fcd->getRegion( 'Hlavní město Praha', 'CZ' );

		Assert::same( 'Česká republika', $r->getCountry()->getName() );
	}


	function testGetCity()
	{
		$c = $this->fcd->getCity( 'Praha' );

		Assert::same( 'Praha', $c->name );
	}


	function testGetPostal()
	{
		$p = $this->fcd->getPostal( '130 00' );

		Assert::same( '130 00', $p->code );
	}


	function testGetDistrict()
	{
		$d = $this->fcd->getDistrict( 'Praha 3' );

		Assert::same( 'Praha 3', $d->name );
	}


	function testGetPart()
	{
		$p = $this->fcd->getPart( 'Žižkov' );

		Assert::same( 'Žižkov', $p->name );
	}


	function testGetStreet()
	{
		$s = $this->fcd->getStreet( 'Pospíšilova' );

		Assert::same( 'Pospíšilova', $s->name );
	}


	function testGetArea()
	{
		$d = [
			'street'	 => "Pospíšilova",
			'reg_nr'	 => "1524",
			'house_nr'	 => "4",
			'postal'	 => "130 00",
			'district'	 => "Praha 3",
			'part'		 => "Žižkov",
			'city'		 => "Praha",
			'region'	 => "Hlavní město Praha",
			'country'	 => "CZ",
		];

		$a = $this->fcd->getArea( $d );


		Assert::same( '130 00', $a->postal->code );
	}


	function testGetAddress()
	{
		$d = [
			'street'	 => "Pospíšilova",
			'reg_nr'	 => "1524",
			'house_nr'	 => "4",
			'postal'	 => "130 00",
			'district'	 => "Praha 3",
			'part'		 => "Žižkov",
			'city'		 => "Praha",
			'region'	 => "Hlavní město Praha",
			'country'	 => "CZ",
		];

		$a = $this->fcd->getAddress( $d );

		Assert::same( '130 00', $a->area->postal->code );
	}


}

$test = new LocationTest( $container );
$test->run();
