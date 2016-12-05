<?php
namespace Puja\Error\Handler;
use Puja\Error\Exception;
class ExceptionHandler extends HandlerAbstract
{
    protected function setHandler()
    {
        set_exception_handler(array($this, 'handler'));
    }

    public function handler(\Exception $exception)
    {
        $errorMessage = array(
            'code' => $exception->getCode(),
            'trace' => $exception->getTrace(),
            'type' => get_class($exception),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'traceMessage' => $exception->getTraceAsString(),
        );
        $this->printError($errorMessage);
    }
}