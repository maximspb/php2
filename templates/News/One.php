<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $article->title ; ?></title>
</head>
<body>

<h1>
    <?php echo $article->title ; ?>
</h1>
<article>
    <?php echo $article->text ; ?>
</article>
<span><?php echo $article->author->name ; ?></span>
<p><a href="/">Читать все новости</a></p>
<p>

</p>
</body>
</html>
