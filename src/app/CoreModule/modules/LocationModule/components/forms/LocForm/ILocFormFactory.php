<?php

namespace Location\Components\Forms;


/**
 * @author Petr Blazicek 2016
 */
interface ILocFormFactory
{
	/** @return \Location\Components\Forms\LocForm */
	function create();
}
