<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.11.17
 * Time: 16:25
 */

namespace App\Exceptions\Validate;

use App\Exceptions\ModelException;

class TextException extends ModelException
{
    protected $message = 'Нет текста';
}
