<table border="1" cellpadding="5" style="border-collapse: collapse">
    <tr>
        <th>№</th>
        <th>Заголовок</th>
        <th colspan="2">Действие</th>
    </tr>

<?php foreach ($models as $model) : ?>

    <tr>
        <?php foreach ($functions as $function) : ?>
            <td><?php echo $function($model) ?></td>
        <?php endforeach; ?>
        <td>
            <a href="/Admin/Form/?id=<?php echo $model->id ; ?>">
                Редактировать
            </a>
        </td>
        <td>
            <a href="/Admin/Delete/?id=<?php echo $model->id ; ?>">
                Удалить
            </a>
        </td>

    </tr>

<?php endforeach; ?>
</table>


