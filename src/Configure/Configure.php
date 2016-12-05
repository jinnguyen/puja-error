<?php
namespace Puja\Error\Configure;
use Puja\Entity\Entity;
/**
 * This comment (docblock) is copied from Puja\Error\Configure\Configure->getDocblock(); you should do it each time you change the Puja\Error\Configure\Configure->attributes
 * @method boolean getEnabled()
 * @method setEnabled(boolean $attr)
 * @method hasEnabled()
 * @method unsetEnabled()
 * @method boolean getDebug()
 * @method setDebug(boolean $attr)
 * @method hasDebug()
 * @method unsetDebug()
 * @method int getErrorLevel()
 * @method setErrorLevel(int $attr)
 * @method hasErrorLevel()
 * @method unsetErrorLevel()
 * @method boolean getErrorDisplay()
 * @method setErrorDisplay(boolean $attr)
 * @method hasErrorDisplay()
 * @method unsetErrorDisplay()
 * @method string getErrorTemplate()
 * @method setErrorTemplate(string $attr)
 * @method hasErrorTemplate()
 * @method unsetErrorTemplate()
 * @method string getErrorDebugTemplate()
 * @method setErrorDebugTemplate(string $attr)
 * @method hasErrorDebugTemplate()
 * @method unsetErrorDebugTemplate()
 * @method mixed getCallbackFn()
 * @method setCallbackFn( $attr)
 * @method hasCallbackFn()
 * @method unsetCallbackFn()
 */
class Configure extends Entity
{
    protected $attributes = array(
        'enabled' => self::DATATYPE_BOOLEAN,
        'debug' => self::DATATYPE_BOOLEAN,
        'error_level' => self::DATATYPE_INT,
        'error_display' => self::DATATYPE_BOOLEAN,
        'error_template' => self::DATATYPE_STRING,
        'error_debug_template' => self::DATATYPE_STRING,
        'callback_fn' => null,
    );
}