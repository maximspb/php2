<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h4>Выберите новость из списка для удаления</h4>
<form action="/admin/delete.php" method="post">
    <select name="id">
        <option  value="" disabled selected>Выберите новость</option>
        <?php foreach ($allArticles as $article) : ?>
            <option value="<?php echo $article->id; ?>">
                <?php echo $article->title; ?>
            </option>

        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" name="delete" value="Удалить">
</form><br>
<a href="/admin/index.php">Вернуться в меню</a>
</body>
</html>