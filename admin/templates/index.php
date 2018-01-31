<?php
//массив $news передается в шаблон из контроллера
$tbl = new \App\AdminDataTable($news, $functions = [
    function ($model) {
        return $model->id;
    },
    function ($model) {
        return $model->title;
    }
]);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ-панель</title>
</head>
<body>
<h1>Список новостей</h1>
<?php $tbl->render(__DIR__.'/admintable.php'); ?>
<br>
<a href="/Admin/Form">Создать новость</a>

</body>
</html>