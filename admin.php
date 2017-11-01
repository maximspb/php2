<?php
require __DIR__.'/autoload.php';

$id =isset($_POST['id']) ? $_POST['id'] : false;
$show = isset($_POST['show'])? $_POST['show']: false;
$title =isset($_POST['title'])? $_POST['title']:null;
$text = isset($_POST['text'])? $_POST['text']:null;
$update = isset($_POST['update']) ? $_POST['update'] : false;
$delete = isset($_POST['delete']) ? $_POST['delete'] : false;
$newTitle = isset($_POST['newTitle']) ? $_POST['newTitle'] : '';
$newText = isset($_POST['newText']) ? $_POST['newText'] : '';
$newArticle = isset($_POST['newArticle'])? $_POST['newArticle']: false;

//операции обновления и удаления:
if ($id) {
    $oneArticle =\App\Models\Article::findById($id);
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
    $newRecord = new \App\Models\Article();
    $newRecord->title = $newTitle;
    $newRecord->text = $newText;
    $newRecord->save();
    header('Location:/admin.php/');
}

//массив актуальных id в базе
$allIds =array_column(\App\Models\Article::getAll(), 'id');

include __DIR__.'/templates/adminTpl.php';
