<?php


/**
 * Class BasePresenter
 *
 * @author Petr Blazicek 2015
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{


	/**
	 * Adjust layouts searching algo
	 * 
	 * @return string
	 */
	public function formatLayoutTemplateFiles()
	{
		$layoutFiles	 = parent::formatLayoutTemplateFiles();
		$dir			 = dirname( $this->reflection->getFileName() );
		$layoutFiles[]	 = $dir . '/../../../../presenters/templates/@layout.latte';
		$layoutFiles[]	 = $dir . '/../../presenters/templates/@layout.latte';
		return $layoutFiles;
	}

}
