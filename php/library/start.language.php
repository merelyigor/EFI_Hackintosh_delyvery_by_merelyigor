<?php

use My_bash_class\My_bash_class;

/**
 * функция выбора языка
 * запускает основные функции в зависимости от выбраного языка
 *
 * @param bool $print = вывод текстового заголовка
 */
function start_choice_language($print = true)
{
    $text_header = "░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

  Choose a script interface language...

  выберите язык интерфейса скрипта...

░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

            1) EN.
            2) RU.
            3) Exit/Выход
            ";

    $bash = new My_bash_class();
    if ($print) {
        $bash->bash("clear");
        $bash->bash_escapeshellarg("printf '\e[8;27;80t'");
        $bash->bash("clear");
        $bash->EEF($text_header);
    }

    $result = readline("INPUT|ВВОД: ");

    $error = error_input(['1', '2', '3'], $result);

    if ($error) {
        $bash->bash("clear");
        $bash->EEF($text_header);
        $bash->EEF($error);
        start_choice_language(false);
    } else {
        if ($result == 1) {
            start_ru(); #TODO сделать запуск на английском
        } elseif ($result == 2) {
            start_ru(); # старт функции на русском языке
        } elseif ($result == 3) {
            exit_program('
            Выход из программы :(
            Exit from the program :(');
        }
    }
}