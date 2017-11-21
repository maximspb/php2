<?php
namespace App\Controllers;


use App\Exceptions\DbRequestException;
use App\Exceptions\ItemNotFoundException;
use App\Models\Article;
use App\Models\Author;
use App\Exceptions\MultiException;

class Admin extends Controller
{


    protected function access()
    {
        /**
         * блокировка доступа к админ-панели. В рамках ДЗ выполнено
         * через добавление "секретного" слова в URL,
         * при наличии которого есть доступ, без него - нет.
         */
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if (in_array('Secret', $url)) {
            return true;
        } else {
            return false;
        }
    }

    protected function actionSecret()
    {
        /**
         * экшен для доступа к главной странице админ-панели
         * при блокировке с паролем в URL
         */
        return $this->actionDefault();
    }

    protected function actionDefault()
    {

        $this->view->news = Article::getAll();
        $this->view->display(__DIR__ . '/../../admin/templates/index.php');
    }

    protected function actionEdit()
    {
        $this->view->errors = [];
        try {
            $this->view->article = \App\Models\Article::findById($_GET['id']);
            $this->view->authors = Author::getAll();
            if (isset($_POST['save'])) :
                $this->view->article->fill($_POST);
                $this->view->article->save();
                header('Location:/Admin/');
                exit();
            endif;
        } catch (ItemNotFoundException $e) {
            echo $e->pageNotFound();
            exit();
        } catch (MultiException $e) {
            $this->view->errors = $e->getAlldata();
        }
        $this->view->display(__DIR__ . '/../../admin/templates/edit.php');
    }

    protected function actionInsert()
    {
        $this->view->errors = [];
        $this->view->article = new Article();
        $this->view->authors = Author::getAll();

        try {
            $this->view->article->fill($_POST);
            try {
                $this->view->article->save();
            } catch (DbRequestException $e) {
                echo $e->getMessage();
                exit;
            }
            if (isset($_POST['save'])) :
                header('Location:/Admin/');
                exit();
            endif;
        } catch (MultiException $e) {
            $this->view->errors = $e->getAlldata();
        }
        $this->view->display(__DIR__ . '/../../admin/templates/edit.php');
    }

    protected function actionDelete()
    {
        $article = \App\Models\Article::findById($_GET['id']);
        if (empty($article)) {
            http_response_code(404);
            exit();
        }
        try {
            $article->delete();
            header('Location:/Admin/');
        } catch (DbRequestException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
