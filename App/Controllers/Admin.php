<?php
namespace App\Controllers;
use App\Exceptions\DbRequestException;
use App\Exceptions\ItemNotFoundException;
use App\Models\Article;
use App\Models\Author;
use App\Exceptions\MultiException;
class Admin extends Controller
{

    protected $article;

    protected function access()
    {
        return true;
    }
    public function __construct()
    {
        parent::__construct();

        if (!empty($_GET['id'])) :
            $this->article = \App\Models\Article::findById($_GET['id']);
        else :
            $this->article = new Article();
        endif;
    }

    protected function actionDefault()
    {
        $this->view->news = Article::getAll();
        $this->view->display(__DIR__ . '/../../admin/templates/index.php');
    }


    protected function actionForm()
    {
        $this->view->article = $this->article;
        $this->view->authors = Author::getAll();
        $this->view->display(__DIR__ . '/../../admin/templates/edit.php');
    }


    protected function actionSave()
    {

        try {
            $this->article->fill($_POST);
            $this->article->save();
            header('Location:/Admin/');
            exit(1);
        } catch (MultiException $e) {
                $this->view->article = $this->article;
                $this->view->article->title =$_POST['title'];
                $this->view->article->text =$_POST['text'];
                $this->view->errors = $e->getAllData();
                $this->actionForm();
        }
    }

    protected function actionDelete()
    {
        $article = \App\Models\Article::findById($_GET['id']);
        if (empty($article)) {
            http_response_code(404);
            exit(1);
        }
        try {
            $article->delete();
            header('Location:/Admin/');
        } catch (DbRequestException $e) {
            echo $e->getMessage();
            exit(1);
        }
    }
}
