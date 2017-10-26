<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ; ?></title>
</head>
<body>
<?php foreach ($news as $article) { ?>
    <a href="/article.php?id=<?php echo $article->id ; ?>">
         <h3>
            <?php echo $article->title ; ?>
         </h3>
    </a>
<?php } ?>
</body>
</html>