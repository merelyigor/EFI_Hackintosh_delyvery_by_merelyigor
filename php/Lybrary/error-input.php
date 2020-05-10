<?php

use My_bash_class\My_bash_class;


function error_input($text_header = '', $options = [], $result = null)
{
    $text_error_input = "
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
            !!! Ошибочный ввод, введите еще раз и нажмите Enter !!!
               !!! Error input, type it again and press Enter !!!
░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    ";

    $bash = new My_bash_class();
    foreach ($options as $option) {
        if ($option == $result)
            return false;
    }

    return $text_error_input;
}