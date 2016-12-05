<?php
include '../vendor/autoload.php';
class A
{
    public function b(array $erroMessage = array())
    {
        print_r($erroMessage); // viewsource to see how this function work
    }
}


use Puja\Error\ErrorManager;
new ErrorManager(array(
    'enabled' => true,
    'debug' => true,
    'error_level' => E_ALL,
    'callback_fn' => array(new A(), 'b'))
);


$a = new A();
$a->c();