# puja-error
Puja-Error are the handler layers, that handle all errors/exceptions for PHP application.

<strong>Install</strong>
<pre>composer require jinnguyen/puja-error</pre>

<strong>Usage</strong>
<pre>
include '/path/to/vendor/autoload.php';
use Puja\Error\ErrorManager;
</pre>

<strong>Examples</strong>
<pre>
class A
{
    public function b(array $erroMessage = array())
    {
        print_r($erroMessage); // viewsource to see how this function work
    }
}


use Puja\Error\ErrorManager;
new ErrorManager(array(
    'enabled' => true, // toggle on/off Error Manager
    'debug' => true, // toggle on/off mode DEBUG
    'error_level' => E_ALL, // same with error_reporting()
    'callback_fn' => array(new A(), 'b')) // callback function, will call after application get error (you can do some stuff like: log errors, roll back db transaction, ...)
);


$a = new A();
$a->c();
</pre>

<strong>Result</strong> <br />
<img src="https://github.com/jinnguyen/puja-error/blob/master/demo/puja-error-demo.png" />
