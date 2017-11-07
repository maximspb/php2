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
<h4>Сделать новую запись:</h4>
<form action="/admin/insert.php" method="post">
    Выберите автора: <br>
    <select name="author_id" id="author">
        <?php foreach ($allAuthors as $author) : ?>
            <option value="<?php echo $author->id ; ?>">
                <?php echo $author->name ; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="newTitle" placeholder="Заголовок"><br>
    <textarea name="newText" cols="50" rows="20" placeholder="Текст">
        </textarea><br>
    <input type="submit" name="newArticle" value="Сделать запись">
</form><br>
<a href="/admin/index.php">Вернуться в меню</a>
</body>
</html>