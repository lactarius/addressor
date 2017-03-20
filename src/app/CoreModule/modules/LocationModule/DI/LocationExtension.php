<?php

namespace LocationModule\DI;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


/**
 * Class LocationExtension
 *
 * @author Petr Blazicek 2016
 */
class LocationExtension extends \Nette\DI\CompilerExtension
	implements \Kdyby\Doctrine\DI\IEntityProvider, \Flame\Modules\Providers\IRouterProvider
{

	public $defaults = [
		'param1' => 0,
	];


	public function getEntityMappings()
	{
		return [ 'Location\Model' => __DIR__ . '/../model' ];
	}


	public function getRoutesDefinition()
	{
		$routeList = new RouteList( 'Location' );
		$routeList[] = new Route( 'location/<presenter>/<action>[/<id>]',
							[
			'presenter'	 => 'Default',
			'action'	 => 'default',
			'id'		 => NULL,
		] );

		return $routeList;
	}


}
