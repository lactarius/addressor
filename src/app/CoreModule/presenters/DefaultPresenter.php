<?php

namespace CoreModule;


/**
 * Class DefaultPresenter
 *
 * @author Petr Blazicek 2016
 */
class DefaultPresenter extends BasePresenter
{

	public function actionDefault()
	{
		$this->redirect( ':Location:Default:default' );
	}


	public function renderDefault()
	{
		
	}


}
