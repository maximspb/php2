<?php
namespace App\Controllers;

use App\Exceptions\Http404Exception;
use App\Exceptions\ItemNotFoundException;
use App\Exceptions\MultiException;
use App\Models\Article;

class Index extends Controller
{


    protected function actionDefault()
    {
        $this->view->news = Article::getLastRec(3);
        $this->view->display(__DIR__ . '/../../templates/News/Default.php');
    }

    protected function actionOne()
    {
        try {
            $this->view->article = Article::findById($_GET['id']);
        } catch (ItemNotFoundException $error) {
            echo $error->pageNotFound();
            exit();
        }
        $this->view->display(__DIR__ . '/../../templates/News/One.php');
    }
}