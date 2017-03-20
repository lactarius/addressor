<?php

namespace Core\Components\Forms;

use Tomaj\Form\Renderer\BootstrapVerticalRenderer;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IContainer;


/**
 * Class BSUIForm
 * 
 * Nette UI\Form with Bootstrap renderer
 *
 * @author Petr Blazicek 2016
 */
class BSUIForm extends Form
{

	public function __construct( IContainer $parent = NULL, $name = NULL )
	{
		parent::__construct( $parent, $name );
		$this->setRenderer( new BootstrapVerticalRenderer() );
	}


}
