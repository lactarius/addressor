<?php

namespace LocationModule;


/**
 * Class BasePresenter
 *
 * @author Petr Blazicek 2015
 */
abstract class BasePresenter extends \CoreModule\BasePresenter
{


	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->title = 'Location';
	}

}
