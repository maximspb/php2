<?php
namespace App\Exceptions;

class ItemNotFoundException extends ModelException
{
    public function pageNotFound()
    {
         include __DIR__.'/templates/404.php';
         http_response_code(404);
    }
}
