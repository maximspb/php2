<?php

namespace App\Exceptions;

class DbConnectException extends ModelException
{
    public function errorPage()
    {
        include __DIR__.'/templates/fatality.php';
    }
}