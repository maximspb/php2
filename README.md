Дз№6. Задача:
Подключить библиотеку SwiftMailer,
отправлять сообщение на почту админа
о проблемах с подключением к БД:
https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/App/Db.php#L39

Дз№7. Задача:
Применить генератор в классе Db.
Сделать метод queryEach(), 
который будет генерировать запись
 за записью из ответа сервера базы данных, 
 не делая fetchAll(), а построчно 
 исполняя fetch():
 https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/App/Db.php#L91
 
 Проверить работу этого метода, использовав его в программе:
 https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/App/Model.php#L40
 https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/App/Controllers/Index.php#L14

Создать класс AdminDataTable:
https://github.com/maximspb/php2/blob/master/App/AdminDataTable.php

Применить этот класс в своей админ-панели:
https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/admin/templates/index.php#L3
https://github.com/maximspb/php2/blob/3d8a785543ab5b6a0c1c19e857976b54017fa8fd/admin/templates/index.php#L23