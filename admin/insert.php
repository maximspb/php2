<?php
require __DIR__.'/../autoload.php';
$view = new \App\View();
$newTitle = isset($_POST['newTitle']) ? $_POST['newTitle'] : null;
$newText = isset($_POST['newText']) ? $_POST['newText'] : null;
$newArticle = isset($_POST['newArticle'])? $_POST['newArticle']: false;
$authorId = isset($_POST['author_id'])? $_POST['author_id']: null;
$db = new \App\Db();
$sql ='SELECT * from authors';
$view->allAuthors = $db->query($sql);

/**
 * создание нового объекта Article и добавление новой записи
 */
if ($newArticle) {
    $newRecord = new \App\Models\Article();
    $newRecord->title = $newTitle;
    $newRecord->text = $newText;
    $newRecord->author_id = $authorId;
    $newRecord->save();
    header('Location:/admin/insert.php');
}
$view->display(__DIR__.'/../templates/insertTpl.php');
