<?php

namespace LocationModule;


/**
 * Class DefaultPresenter
 *
 * @author Petr Blazicek 2016
 */
class DefaultPresenter extends BasePresenter
{

	/** @var \Location\Components\Forms\ILocFormFactory @inject */
	public $geoFormFactory;


	protected function createComponentLocForm()
	{
		$control = $this->geoFormFactory->create();
		$control->setShort( TRUE );
		return $control;
	}

}
