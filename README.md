# php2
1. Скорректировано название абстрактного класса Model
2.Скорректирован метод findById($id), теперь он возвращает один объект вместо массива.
3. В модель Article добавлен публичный метод getLastRec(int $num), с помощью которого производится вывод последних n новостей, где n - аргумент $num.
