<?php
namespace Puja\Error\Handler;
use Puja\Error\Configure;
use Puja\Error\Exception;

abstract class HandlerAbstract
{
    protected $configure;
    protected $templateDir;
    public function __construct(Configure\Configure $configure)
    {
        $this->configure = $configure;
        $this->templateDir = dirname(__FILE__) . '/../';
        if ($this->configure->getEnabled()) {
            $this->setHandler();
        }

    }

    abstract protected function setHandler();

    protected function getErrorLevel($errorNo)
    {
        $error_code = array();
        $error_code[E_NOTICE] = 'E_NOTICE ';
        $error_code[E_WARNING] = 'E_WARNING';
        $error_code[E_ERROR] = 'E_ERROR ';
        $error_code[E_RECOVERABLE_ERROR] = 'E_RECOVERABLE_ERROR';
        $error_code[E_PARSE] = 'E_PARSE';
        $error_code[E_STRICT] = 'E_STRICT';
        $error_code[E_DEPRECATED] = 'E_DEPRECATED';
        $error_code[E_CORE_ERROR] = 'E_CORE_ERROR';
        $error_code[E_CORE_WARNING] = 'E_CORE_WARNING';
        $error_code[E_COMPILE_ERROR] = 'E_COMPILE_ERROR';
        $error_code[E_COMPILE_WARNING] = 'E_COMPILE_WARNING';
        $error_code[E_USER_ERROR] = 'E_USER_ERROR';
        $error_code[E_USER_WARNING] = 'E_USER_WARNING';
        $error_code[E_USER_NOTICE] = 'E_USER_NOTICE';
        $error_code[E_USER_DEPRECATED] = 'E_USER_DEPRECATED';
        $error_code[E_ALL] = 'E_ALL';
        $errorLevel = 'Undefined';
        if (!empty($error_code[$errorNo])) {
            $errorLevel = $error_code[$errorNo];
        }

        return $errorLevel;
    }

    protected function printError($errorMessage = array())
    {
        header('Content-type:text/html', null, 500);

        if ($this->configure->getDebug()) {
            echo $this->traceErrorDebug($errorMessage);
        } else {
            echo $this->traceError($errorMessage);
        }
        $this->setCallbackFn($errorMessage);
        exit;
    }

    protected function traceError(array $errorMessage = array())
    {
        $errorTemplate = $this->templateDir . 'template/error.tpl';
        if ($this->configure->getErrorTemplate()) {
            $errorTemplate = $this->configure->getErrorTemplate();
        }
        if (!file_exists($errorTemplate)) {
            die('File ' . $errorTemplate . ' doesnt exist');
        }

        return file_get_contents($errorTemplate, true);
    }

    protected function traceErrorDebug($errorMessage)
    {
        $errorTemplate = $this->templateDir . 'template/error-debug.tpl';
        if ($this->configure->getErrorDebugTemplate()) {
            $errorTemplate = $this->configure->getErrorDebugTemplate();
        }
        if (!file_exists($errorTemplate)) {
            die('File ' . $errorTemplate . ' doesnt exist');
        }

        $errorHtml = file_get_contents($errorTemplate, true);
        $array_replace = array(
            '{{exception_type}}' => $errorMessage['type'],
            '{{exception_code}}' => $errorMessage['code'],
            '{{exception_message}}' => $errorMessage['message'],
            '{{exception_file}}' => $errorMessage['file'],
            '{{exception_line}}' => $errorMessage['line'],
            '{{exception_trace}}' => $errorMessage['traceMessage'],
            '{{request_method}}' => $_SERVER['REQUEST_METHOD'],
            '{{request_get}}' => $this->getTableData($_GET),
            '{{request_post}}' => $this->getTableData($_POST),
            '{{request_file}}' => $this->getTableData($_FILES),
            '{{server_info}}' => $this->getTableData($_SERVER, true),
            '{{php_version}}' => PHP_VERSION,
            '{{request_url}}' => $_SERVER['REQUEST_URI'],
            '{{fatal_class}}' => !empty($errorMessage['is_fatal']) ? 'fatal' : '',
        );
        return str_replace(
            array_keys($array_replace),
            array_values($array_replace),
            $errorHtml
        );
    }

    protected function getTableData($data, $tableFormat = false)
    {
        if (empty($tableFormat)) {
            if (empty($data)) {
                return 'No data';
            }

            return print_r($data, true);
        }

        $dataStr = '<table class="gray" width="100%" cellspacing="2" cellpadding="2"><tr><th width="250">Variable</th><th>Value</th></tr>';
        if (empty($data)) {
            $dataStr .= '<td colspan="2">No data</td>';
        } else {
            foreach ($data as $key => $value) {
                $dataStr .= '<tr><td>' . $key . '</td><td>' . print_r($value, true) . '</td></tr>';
            }
        }

        $dataStr .= '</table>';
        return $dataStr;
    }

    protected function setCallbackFn(array $errorMessage = array())
    {

        $callbackFn = $this->configure->getCallbackFn();
        if (!empty($callbackFn)) {
            call_user_func($callbackFn, $errorMessage);
        }
    }
}