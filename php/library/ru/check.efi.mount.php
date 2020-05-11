<?php

use My_bash_class\My_bash_class;

/**
 * функция проверки смонтированного EFI раздела
 * проверяет смонтирован или нет раздел ESP
 *
 * @param bool $print = вывод текстового заголовка
 */
function check_efi_mount($print = true, $location = 'boot_loader_select_repo', $data = null)
{
    $bash = new My_bash_class();
    $text_header_error = "
  У вас нет смонтированного раздела EFI
  Смонтируйте EFI раздел диска или флешки и повторите попытку

  1:Повторить попытку
  2:Выход из программы
  
";

    if (file_exists('/Volumes/EFI/')) {
        if ($location == 'boot_loader_select_repo')
            boot_loader_select_repo();                              # Запус выбора репозитория для загрузки
        elseif ($location == 'efi')
            delivery_efi($data, true);
        elseif ($location == 'config')
            delivery_config($data, true);
    } else {
        if ($print) {
            $bash->bash("clear");
            print_main_header();
            print_error_text();
            echo $text_header_error;
        }

        $result = readline("INPUT|ВВОД: ");

        $error = error_input(['1', '2'], $result);

        if ($error) {
            $bash->bash("clear");
            print_main_header();
            print_error_text();
            $bash->EEF($text_header_error);
            $bash->EEF($error);
            check_efi_mount(false);
        } else {
            if ($result == 1) {
                check_efi_mount(true);
            } elseif ($result == 2) {
                exit_program('Bыxᴏд из программы :(');
            }
        }
    }
}