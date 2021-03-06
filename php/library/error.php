<?php

use My_bash_class\My_bash_class;

/**
 * функция вывода заголовка ошибки (не выходит из программы не принимает текст для вывода)
 * просто вывод текст ошибки
 */
function print_error_text()
{
    $bash = new My_bash_class();
    $bash->EEF("::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::'########:'########::'########:::'#######::'########:::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::##.....:: ##.... ##: ##.... ##:'##.... ##: ##.... ##::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::##::::::: ##:::: ##: ##:::: ##: ##:::: ##: ##:::: ##::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::######::: ########:: ########:: ##:::: ##: ########:::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::##...:::: ##.. ##::: ##.. ##::: ##:::: ##: ##.. ##::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::##::::::: ##::. ##:: ##::. ##:: ##:::: ##: ##::. ##:::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::########: ##:::. ##: ##:::. ##:. #######:: ##:::. ##::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::........::..:::::..::..:::::..:::.......:::..:::::..::::::::::::::::::::::::::::::::::::::::::::");
}

/**
 * функция роверки на введеные ользоваелем коректные даные
 *
 * @param array $options = доступные для ввода пользователем опции
 * @param string $result = опция которую ввел пользователь
 *
 * @return string $text_error_input = текст ошибки некоректного ввода пользователем
 */
function error_input($options = [], $result = null)
{
    $text_error_input = "
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
            !!! Ошибочный ввод, введите еще раз и нажмите Enter !!!
               !!! Error input, type it again and press Enter !!!
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    ";

    if (is_array($options) && !empty($options)) {
        foreach ($options as $option)
            if ($option == $result)
                return false;
    } else {
        exit('вы не передали в error_input параметры для перебора опций');
    }

    return $text_error_input;
}