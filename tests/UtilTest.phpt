<?php

use Nette;
use Tester;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


/**
 * Test Class UtilTest
 *
 * @author Petr Blazicek 2016
 */
class UtilTest extends Tester\TestCase
{

	/** @var Nette\DI\Container */
	private $container;


	function __construct( Nette\DI\Container $container )
	{
		$this->container = $container;
	}


	function testXY()
	{
		$a = file( __DIR__ . '/../res/cz.csv' );

		$sql = 'INSERT INTO lc_country (code_num,code_alpha2,code_alpha3,name,name_short,name_eng,name_eng_short) VALUES';
		foreach ( $a as $l ) {
			$c = explode( '","', trim( $l, '"' ), 8 );
			if ( $c[ 0 ] > 0 ) {
				$sql .= vsprintf( '(%u,"%s","%s","%s","%s","%s","%s"),', $c );
			}
		}

		$sql = rtrim( $sql, ',' ) . ';';
		file_put_contents( __DIR__ . '/tmp/country.sql', $sql );

		Assert::true( TRUE );
	}


}

$test = new UtilTest( $container );
$test->run();
