<?php
require __DIR__.'/autoload.php';

$view = new \App\View();
$id =isset($_POST['id']) ? $_POST['id'] : false;
$view->show = isset($_POST['show'])? $_POST['show']: false;
$title =isset($_POST['title'])? $_POST['title']:null;
$text = isset($_POST['text'])? $_POST['text']:null;
$update = isset($_POST['update']) ? $_POST['update'] : false;
$delete = isset($_POST['delete']) ? $_POST['delete'] : false;
$newTitle = isset($_POST['newTitle']) ? $_POST['newTitle'] : '';
$newText = isset($_POST['newText']) ? $_POST['newText'] : '';
$newArticle = isset($_POST['newArticle'])? $_POST['newArticle']: false;
$authorId = isset($_POST['author_id'])? $_POST['author_id']: null;
$db = new \App\Db();
$sql ='SELECT * from authors';
$view->allAuthors = $db->query($sql);


//операции обновления и удаления:
if ($id) {
    $view->oneArticle =\App\Models\Article::findById($id);
    $oneArticle = $view->oneArticle;
    if ($update) {
        $oneArticle->title = $title;
        $oneArticle->text = $text;
        $oneArticle->save();
        header('Location:/admin.php/');

    }
    if ($delete) {
        $oneArticle->delete();
        header('Location:/admin.php/');
    }

}

//Добавление новой записи в базу данных
if ($newArticle) {
    $view->newRecord = new \App\Models\Article();
    $newRecord = $view->newRecord;
    $newRecord->title = $newTitle;
    $newRecord->text = $newText;
    $newRecord->author_id = $authorId;
    $newRecord->save();
    header('Location:/admin.php/');
}


//массив актуальных id новостей в базе:
$view->allIds =array_column(\App\Models\Article::getAll(), 'id');

$view->display(__DIR__.'/templates/adminTpl.php');
