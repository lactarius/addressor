<?php

namespace Core\Components\Forms;

use Tomaj\Form\Renderer\BootstrapVerticalRenderer;
use Nette\Forms\Form;


/**
 * Class BSForm
 * 
 * Nette Form with Bootstrap renderer
 *
 * @author Petr Blazicek 2016
 */
class BSForm extends Form
{

	public function __construct( $name = NULL )
	{
		parent::__construct( $name );
		$this->setRenderer( new BootstrapVerticalRenderer() );
	}


}
