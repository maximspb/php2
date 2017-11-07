<?php
require __DIR__.'/../autoload.php';

$view = new \App\View();
$id =isset($_POST['id']) ? $_POST['id'] : false;
$view->show = isset($_POST['show'])? $_POST['show']: false;
$title =isset($_POST['title'])? $_POST['title']:null;
$text = isset($_POST['text'])? $_POST['text']:null;
$update = isset($_POST['update']) ? $_POST['update'] : false;
$view->allArticles = \App\Models\Article::getAll();

if ($id) {
    $view->oneArticle =\App\Models\Article::findById($id);
    if ($update) {
        $view->oneArticle->title = $title;
        $view->oneArticle->text = $text;
        $view->oneArticle->save();
        header('Location:/admin/update.php');
    }
}
$view->display(__DIR__.'/../templates/updateTpl.php');
