<?php

use My_bash_class\My_bash_class;

function start_choice_language($print = true)
{
    $text_header = "░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

  Произходит инициалицация скрипта и запуск, подождите...

  Initialization of the script and start, wait...

░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

                    Choose a script interface language
                    Выбирете язык интерфейса скрипта

                    1) EN.
                    2) RU.
                    3) Exit/Выход";

    $bash = new My_bash_class();
    if ($print) {
        $bash->bash("clear");
        $bash->bash_escapeshellarg("printf '\e[8;27;80t'");
        $bash->bash("clear");
        $bash->EEF($text_header);
    }

    $result = readline("INPUT|ВВОД: ");

    $error = error_input($text_header, ['1', '2', '3'], $result);

    if ($error) {
        $bash->bash("clear");
        $bash->EEF($text_header);
        $bash->EEF($error);
        start_choice_language(false);
    } else {
        if ($result == 1) {
            var_dump('1) EN.');
        } elseif ($result == 2) {
            start_ru();
        } elseif ($result == 3) {
            exit_program('
            Выход из программы :(
            Exit from the program :(');
        }
    }

}