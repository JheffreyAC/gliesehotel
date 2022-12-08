<?php
// --
spl_autoload_register(function ($class) {
	if (!file_exists($file = dirname(__FILE__) . '/' . $class . '.php')) return;
	require_once($file);
});
