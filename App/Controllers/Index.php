<?php
namespace App\Controllers;

use App\Exceptions\Exception404;
use App\Models\Article;

class Index extends Controller
{


    protected function actionDefault()
    {
	    //$news = Article::getLastRec(3);
        $this->view->news = Article::findAll();
        $this->view->display(__DIR__ . '/../../templates/News/Default.php');
    }

    protected function actionOne()
    {
        try {
            $this->view->article = Article::findById($_GET['id']);
        } catch (Exception404 $error) {
            echo $error->getMessage();
            exit(1);
        }
        $this->view->display(__DIR__ . '/../../templates/News/One.php');
    }
}