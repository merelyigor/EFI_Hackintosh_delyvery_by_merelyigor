<?php
/**
 * функция запуска скрипта
 */
function start()
{
    # запус выбора языка
    start_choice_language();

    drop_folder_program_core();
    end_program("Программа завершила работу успешно. "); # конечная точка выход из программы на русском
}