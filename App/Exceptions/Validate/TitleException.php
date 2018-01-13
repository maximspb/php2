<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 13.01.18
 * Time: 1:34
 */

namespace App\Exceptions\Validate;

use App\Exceptions\ModelException;

class TitleException extends ModelException
{
    protected $message ='Пустой заг';
}