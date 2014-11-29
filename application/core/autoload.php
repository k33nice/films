<?php
spl_autoload_register( function ($className)
{
    $fileName = $className . '.php';
    include $fileName;
});