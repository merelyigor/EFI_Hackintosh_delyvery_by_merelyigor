<?php
/**
 * функция запуска скрипта
 */

use My_bash_class\My_bash_class;

$bash = new My_bash_class();
$bash->bash("
trap ctrl_c INT

function ctrl_c() {
    rm -rf ~/Downloads/EFI_Hackintosh_delyvery_by_merelyigor
}");

//$bash->bash_escapeshellarg("printf '\e[8;27;80t'");

function start()
{
    # запус выбора языка
    start_choice_language();

    drop_folder_program_core();
    end_program("Программа завершила работу успешно. "); # конечная точка выход из программы на русском
}


