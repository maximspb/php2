<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.11.17
 * Time: 8:08
 */

namespace App\Exceptions;


class ItemNotFoundException extends ModelException
{
    public function pageNotFound()
    {
         include __DIR__.'/templates/404.php';
         http_response_code(404);
    }
}
