<?php
namespace Puja\Error\Handler;
use Puja\Error\ErrorException;
class FatalHandler extends HandlerAbstract
{
    protected function setHandler()
    {
        register_shutdown_function(array($this, 'handler'));
    }

    public function handler()
    {
        $last_error = error_get_last();
        if ($last_error) {
            $trace = array($last_error);
            $errorMessage = array(
                'code' => $last_error['type'],
                'trace' => $trace,
                'type' => $this->getErrorLevel($last_error['type']),
                'message' => 'Fatal Error: ' . $last_error['message'],
                'file' => $last_error['file'],
                'line' => $last_error['line'],
                'traceMessage' => '#0 ' . $last_error['file'] . ':' . $last_error['line'],
                'is_fatal' => true,
            );

            $this->printError($errorMessage);
        }

    }
}