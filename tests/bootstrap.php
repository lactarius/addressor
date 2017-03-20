<?php

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();

$configurator = new Nette\Configurator;
//$configurator->setDebugMode(FALSE);
$configurator->enableDebugger( __DIR__ . '/tmp' );
$configurator->setTempDirectory( __DIR__ . '/tmp' );
$configurator->createRobotLoader()
	->addDirectory( __DIR__ . '/../src/app' )
	->register();

$configurator->addConfig( __DIR__ . '/../src/app/config/config.neon' );
$configurator->addConfig( __DIR__ . '/config.tests.neon' );

return $configurator->createContainer();
