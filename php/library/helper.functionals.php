<?php

use My_bash_class\My_bash_class;

/**
 * функция делает из строки hexadecimal (16тиричными) данными строку с base64 данными
 *
 * @param string $hex = строка содержащая hexadecimal
 *
 * @return string $base64 = строка содержащая base64
 */
function hex_to_base64($hex)
{
    $return = '';
    foreach (str_split($hex, 2) as $pair) {
        $return .= chr(hexdec($pair));
    }
    $base64 = base64_encode($return);
    return $base64;
}

/**
 * функция делает из строки base64 строку с hex (16тиричными) данными
 *
 * @param string $base64 = строка содержащая base64
 *
 * @return string $hex = строка содержащая hexadecimal
 */
function base64_to_hex($base64)
{
    $binary = base64_decode($base64);
    $hex = bin2hex($binary);
    return $hex;
}

/**
 * Просто выводит текст Произходит магия, подождите немного на соответственном языыке
 *
 * @param string $language = строка локализации для вывода текста
 */
function print_magic_wait($language)
{
    if ($language == 'ru')
        $text = PHP_EOL . 'Произходит магия, подождите немного...' . PHP_EOL . PHP_EOL;
    elseif ($language == 'en')
        $text = PHP_EOL . 'Magic happens, wait a little bit...' . PHP_EOL . PHP_EOL;
    else
        $text = 'Произходит магия, подождите немного... / Magic happens, wait a little bit...';
    $bash = new My_bash_class();
    $bash->bash("clear");
    print_main_header();
    echo '';
    echo $text;
    echo '';
}

/**
 * Удаляет папку с ядром и файлами программы из системы пользователя
 */
function drop_folder_program_core()
{
    $bash = new My_bash_class();
    $bash->bash("sh ~/EFI_Hackintosh_delyvery_by_merelyigor/clear.sh");
}