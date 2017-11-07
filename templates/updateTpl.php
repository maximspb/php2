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
<body>
<h4>Выберите новость по ID для обновления:</h4>

<form action="/admin/update.php" method="post">
    <select name="id">
        <option  value="" disabled>Выберите id</option>
            <?php foreach ($allArticles as $article) : ?>
                <option value="<?php echo $article->id; ?>"<?php echo 'selected=selected'; ?>>
                    <?php echo $article->id; ?>
                </option>
            <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" name="show" value="Показать запись"><br>
    <textarea name="title" cols="50" rows="1">
                <?php if ($show) :
                    echo $oneArticle->title;
                endif; ?>
            </textarea><br>
    <textarea cols="50" rows="20" name="text">
                <?php if ($show) :
                    echo $oneArticle->text;
                endif; ?>
            </textarea><br>
    <input type="submit" name="update" value="сохранить изменения">
</form><br>
<a href="/admin/index.php">Вернуться в меню</a>
</body>
</html>