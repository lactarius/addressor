<?php

namespace CoreModule\DI;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


/**
 * Class CoreExtension
 *
 * @author Petr Blazicek 2015
 */
class CoreExtension extends \Nette\DI\CompilerExtension
	implements \Flame\Modules\Providers\IRouterProvider, \Kdyby\Doctrine\DI\IEntityProvider
{

	public function getEntityMappings()
	{
		return [ 'Core\Model' => __DIR__ . '/../model' ];
	}


	public function getRoutesDefinition()
	{
		$routeList = new RouteList( 'Core' );
		$routeList[] = new Route( '<presenter>/<action>[/<id>]',
							[
			'presenter'	 => 'Default',
			'action'	 => 'default',
			'id'		 => NULL,
			] );

		return $routeList;
	}


}
