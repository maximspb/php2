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
    <h4>Выберите новость по ID для обновления:</h4>
    <form action="/admin.php" method="post">

        <select name="id">
            <option  value="" disabled>Выберите id</option>
            <?php foreach ($allIds as $idNumber) : ?>
                <option value="<?php echo $idNumber; ?>"<?php echo 'selected=selected'; ?>>
                <?php echo $idNumber; ?>
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
        <input type="submit" name="delete" value="Удалить из базы">
    </form>

    <h4>Сделать новую запись:</h4>
    <form action="/admin.php" method="post">
        <input type="text" name="newTitle" placeholder="Заголовок"><br>
        <textarea name="newText" cols="50" rows="20" placeholder="Текст">
        </textarea><br>
        <input type="submit" name="newArticle" value="Сделать запись">
    </form>
</body>
</html>
