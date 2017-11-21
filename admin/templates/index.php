<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список новостей</title>
</head>
<body>
<h1>Список новостей</h1>
<table>
    <tr>
        <th>№</th>
        <th>Заголовок</th>
    </tr>
    <?php foreach ($news as $article) : ?>
    <tr>
        <td><?php echo $article->id ; ?></td>
        <td><?php echo $article->title ; ?></td>
        <td>
            <a href="/Admin/Edit/?id=<?php echo $article->id ; ?>">
                Редактировать
            </a>
        </td>
        <td>
            <a href="/Admin/Delete/?id=<?php echo $article->id ; ?>">
                Удалить
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table><br>
<a href="/Admin/Insert">Создать новость</a>
</body>
</html>