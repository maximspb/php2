# php2
1. Скорректировано название абстрактного класса Model
2.Скорректирован метод findById($id), теперь он возвращает один объект вместо массива.
3. В модель Article добавлен публичный метод getLastRec(int $num), с помощью которого производится вывод последних n новостей, где n - аргумент $num.

Создан класс-синглтон Config, добавлены методы insert(), update(), delete() и save() в Model. Добавлена простейшая админ-панель с возможностью обновлять, удалять и добавлять записи путем activeRecord.

Добавлен трейт с магическими методами. Добавлен класс Author.

Класс Author наследуется от Model. Метод __get() класса Article возвращает объект класса Author при обращении к свойству ->author.
