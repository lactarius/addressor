<?php

namespace Location\Components\Forms;

use Nette\Application\UI;
use Nette\ComponentModel\IContainer;
use Nette\Utils\Strings;
use function dump;


/**
 * Class LocForm
 *
 * @author Petr Blazicek 2016
 */
class LocForm extends UI\Control
{

	/** @var \Location\Model\LocationFacade */
	private $facade;

	/** @var bool */
	private $short;


	public function __construct( \Location\Model\LocationFacade $facade,
							  IContainer $parent = NULL, $name = NULL )
	{
		parent::__construct( $parent, $name );
		$this->facade = $facade;
	}


	/**
	 * Detailed form fabrique
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentDetailForm()
	{
		$form = new UI\Form();
		$form->getElementPrototype()->id = 'lc_form';

		$form->addHidden( 'formatted' );

		$form->addText( 'place' )
			->setAttribute( 'id', 'lc_autocomplete' )
			->setAttribute( 'placeholder', 'Search for place' )
			->setAttribute( 'autofocus' );

		$form->addText( 'street' )
			->setAttribute( 'placeholder', 'Street' );

		$form->addText( 'reg_nr' )
			->setAttribute( 'placeholder', 'Reg. nr.' );

		$form->addText( 'house_nr' )
			->setAttribute( 'placeholder', 'House nr.' );

		$form->addText( 'postal' )
			->setAttribute( 'placeholder', 'Postcode' );

		$form->addText( 'district' )
			->setAttribute( 'placeholder', 'District' );

		$form->addText( 'part' )
			->setAttribute( 'placeholder', 'Part' );

		$form->addText( 'city' )
			->setAttribute( 'placeholder', 'City' );

		$form->addText( 'region' )
			->setAttribute( 'placeholder', 'Region' );

		$form->addText( 'country' )
			->setAttribute( 'placeholder', 'Country' );

		$form->addSubmit( 'save', 'Save' )
			->setAttribute( 'id', 'lc_save' );

		$form->onSuccess[] = $this->process;

		return $form;
	}


	/**
	 * Short version form fabrique
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentShortForm()
	{
		$form = new UI\Form();
		$form->getElementPrototype()->id = 'lc_form';

		$form->addHidden( 'formatted' );
		$form->addHidden( 'street' );
		$form->addHidden( 'reg_nr' );
		$form->addHidden( 'house_nr' );
		$form->addHidden( 'postal' );
		$form->addHidden( 'district' );
		$form->addHidden( 'part' );
		$form->addHidden( 'city' );
		$form->addHidden( 'region' );
		$form->addHidden( 'country' );

		$form->addText( 'place' )
			->setAttribute( 'id', 'lc_autocomplete' )
			->setAttribute( 'placeholder', 'Search for place' )
			->setAttribute( 'autofocus' );

		$form->addSubmit( 'save', 'Save' )
			->setAttribute( 'id', 'lc_save' );

		$form->onSuccess[] = $this->process;

		return $form;
	}


	/**
	 * Form type setter
	 * 
	 * @param bool $short
	 * @return self (fluent interface)
	 */
	public function setShort( $short = TRUE )
	{
		$this->short = $short;
		return $this;
	}


	/**
	 * Saves current place address
	 * 
	 * @param \Nette\Application\UI\Form $form
	 */
	public function process( UI\Form $form )
	{
		$data = $form->getValues();
		$address = $this->facade->getAddress( $data );
		if ( $address ) {
			$this->flashMessage( "Address [ {$data[ 'formatted' ]} ] successfully saved.  [ Click to close message ]",
						'success' );
			$this->redrawControl( 'flash' );
		}
	}


	/**
	 * Renders the form component
	 */
	public function render()
	{
		$template = $this->template;
		$template->setFile( __DIR__ . ($this->short ? '/shortTemplate.latte' : '/detailTemplate.latte') );

		$template->render();
	}


}
