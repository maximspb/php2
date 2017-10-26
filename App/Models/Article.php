<?php
namespace Models;

use Models\News;

class Article extends News
{
    protected static $table = 'news';
    public $id;
    public $title;
    public $text;
}
