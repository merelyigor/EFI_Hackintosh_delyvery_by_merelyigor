<?php

use My_bash_class\My_bash_class;

/**
 * начальная функция запуска скрипта на русском языке
 */
function start_ru()
{
    $bash = new My_bash_class();
    $bash->bash_escapeshellarg("printf '\e[8;55;140t'");
    $bash->bash("clear");
    print_main_header();

    # запуск функции проверки монтированного EFI раздела
    check_efi_mount();
}