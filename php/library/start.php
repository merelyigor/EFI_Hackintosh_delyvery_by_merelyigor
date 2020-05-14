<?php
/**
 * функция запуска скрипта
 */

use My_bash_class\My_bash_class;

$bash = new My_bash_class();
# Удаляю папку со скриптом при нажатии Ctrl+C (вызывается bash функция ctrl_c() с помощью trap ctrl_c INT)
$bash->bash("
trap ctrl_c INT

function ctrl_c() {
    rm -rf {$FOLDER_SCRIPT}
}");


var_dump($bash->bash('echo $FOLDER_SCRIPT'));

die();

function start()
{
    # запус выбора языка
    start_choice_language();

    drop_folder_program_core();
    end_program("Программа завершила работу успешно. "); # конечная точка выход из программы на русском
}


