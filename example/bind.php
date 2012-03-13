<?php
// +----------------------------------------------------------+
// | Sweetie Dependency Injection 2012                        |
// +----------------------------------------------------------+

include 'classes.php';

use Sweetie\Binder;

$f = function($name) {
    $parts = explode('\\', $name);

    $path = sprintf('../src/%s.php', implode(DIRECTORY_SEPARATOR, $parts));
    include $path;
};

spl_autoload_register($f);

$reader = new \Sweetie\Reader\XML();
$reader->load('bind.xml');

Binder::boostrap($reader);

/* @var $foo Foo */
$foo = Binder::factory('stubTest');
echo $foo->getBar()->sayHello();