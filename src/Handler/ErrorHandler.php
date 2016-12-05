<?php
namespace Puja\Error\Handler;
use Puja\Error\ErrorException;
use Puja\Error\Configure;
class ErrorHandler extends HandlerAbstract
{
    protected function setHandler()
    {
        ini_set('display_errors', $this->configure->getErrorDisplay());
        ini_set('display_startup_errors', $this->configure->getErrorDisplay());
        ini_set('track_errors', true);
        set_error_handler(array($this, 'handler'));
    }

    public function handler($errno, $errstr, $errfile, $errline)
    {
        $check_error = $this->configure->getErrorLevel() & $errno;
        if (!$check_error) {
            return false;
        }

        $errorLevel = $this->getErrorLevel($errno);
        $errorMessage = array(
            'code' => $errno,
            'type' => $errorLevel,
            'message' => $errorLevel . ': ' . $errstr,
            'file' => $errfile,
            'line' => $errline,
            'traceMessage' => '#0 ' . $errfile . ':' . $errline,
        );
        $errorMessage['trace'] = $errorMessage;
        $this->printError($errorMessage);
    }
}