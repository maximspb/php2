<?php
require __DIR__.'/../autoload.php';

$delete = isset($_POST['delete']) ? $_POST['delete'] : false;
$id =isset($_POST['id']) ? $_POST['id'] : false;

$view = new \App\View();
$view->allArticles = \App\Models\Article::getAll();

if ($delete) {
    $view->oneArticle =\App\Models\Article::findById($id);
    $view->oneArticle->delete();
    header('Location:/admin/delete.php');
}
$view->display(__DIR__.'/../templates/deleteTpl.php');
