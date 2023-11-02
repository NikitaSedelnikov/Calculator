<?php

function loadClass($class)
{
    if (file_exists($class.'.php'))
    {
        include_once  $class . '.php';
    }
}
spl_autoload_register("loadClass");
include_once 'html-calc.php';

?>

