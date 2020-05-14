#!/usr/bin/php
<?php
include_once "library/My.bash.class.php";           # основной класс выполнения bash команд
use My_bash_class\My_bash_class;

$bash = new My_bash_class();

define('SCRIPT_RUN', true);                         # точка включения или выключения скрипта

# Папка куда распологается скрипт при запуске и от куда удаляется
$FOLDER_SCRIPT = $bash->bash('echo $FOLDER_SCRIPT');

$bash = new My_bash_class();
# Удаляю папку со скриптом при нажатии Ctrl+C (вызывается bash функция ctrl_c() с помощью trap ctrl_c INT)
$bash->bash("
trap ctrl_c INT

function ctrl_c() {
    rm -rf {$FOLDER_SCRIPT}
}");

/**
 * подключение всех зависимых функций
 */

include_once "library/helper.functionals.php";      # разные вспомогательные функции

include_once "library/start.php";                       # стартовая функция всего скрипта

include_once "library/exit.program.php";            # выводы текстов при выходе из программы

include_once "library/error.php";                   # обработка ошибок и вывод текстов ошибок

include_once "library/start.language.php";          # функция выбора языка для старта скрипта на разных языках

include_once "library/ru/main.php";                 # стартовая точка скрипта на русском языке

if (SCRIPT_RUN)                                     # проверка по точке включения или выключения скрипта
    start();
