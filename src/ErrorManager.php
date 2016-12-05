<?php
namespace Puja\Error;
class ErrorManager
{
    public function __construct(array $configure = array())
    {
        $configure = new Configure\Configure($configure);
        new Handler\ErrorHandler($configure);
        new Handler\ExceptionHandler($configure);
        new Handler\FatalHandler($configure);
    }
}

