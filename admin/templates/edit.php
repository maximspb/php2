<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование новости</title>
</head>
<body>

<form action="" method="post">
    id Автора:<br>
    <select name="author_id" id="">
        <?php foreach ($authors as $author) : ?>
            <option value="<?php echo $author->id ; ?>">
                <?php echo $author->id ; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="hidden" name="id" value="<?php echo $article->id ; ?>">
    <label for="">
        Заголовок новости:<br>
        <input type="text" name="title" value="<?php echo $article->title ; ?>">
    </label><br>
    <label for="">
        Текст новости:<br>
        <textarea name="text" cols="50" rows="20"><?php echo $article->text ; ?></textarea>
    </label><br>
    <input type="submit" name="save">
</form>
<?php foreach($errors as $e):
echo $e->getmessage(); ?><br>
<?php endforeach;
 ?>
</body>
</html>