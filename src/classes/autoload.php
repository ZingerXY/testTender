<?php

spl_autoload_register('autoloadClasses');

function autoloadClasses($classname) {
	include_once $classname . ".php";
}