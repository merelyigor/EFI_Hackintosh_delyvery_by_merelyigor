<?php

use My_bash_class\My_bash_class;

/**
 * Функция перемещения temp-file-config.plist в /Volumes/EFI/EFI/CLOVER раздела ESP
 *
 * @param string $path_config_temp = полный путь к файлу temp-file-config.plist
 * @param bool $check = была ли проведена проверка на монтирование раздела ESP
 */
function delivery_config($path_config_temp, $check = false)
{
    if (!$check)
        check_efi_mount(true, 'config', $path_config_temp);
    $bash = new My_bash_class();

    print_magic_wait('ru');

    $bash->bash("mv -f {$path_config_temp} /Volumes/EFI/EFI/CLOVER/config.plist");

    # русский текст сгенирирован тут http://vkontakte.doguran.ru/kak-pisat-simvolami.php
    boot_loader_select_repo(true, "
                                ████ ████ █  █ ███ ███ ████   ████ █   ███ ███    ███ █ █ ████ ████ ███ █   █ █  █ ████ 
                                █  █ █  █ ██ █ █    █  █      █  █ █    █  █       █  █ █ █  █ █  █ █   █   █ █  █ █  █ 
                                █    █  █ █ ██ ███  █  █ ██   ████ █    █  ███     █  ███ █    █  █ ███ █ █ █ ████ █  █ 
                                █  █ █  █ █  █ █    █  █  █   █    █    █    █     █    █ █  █ █  █ █   █ █ █ █  █ █  █ 
                                ████ ████ █  █ █   ███ ████ █ █    ███ ███ ███     █  ███ ████ █  █ ███ █████ █  █ ████ 

                                                    ████ ███ ████ ███ █   █ ███ █   █  ███ █  █
                                                    █  █ █   █  █ █   ██ ██ █   █   █  █   █  █
                                                    █  █ ███ ████ ███ █ █ █ ███ █ █ █  ███ ████
                                                    █  █ █   █    █   █   █ █   █ █ █  █   █  █
                                                    █  █ ███ █    ███ █   █ ███ ██████ ███ █  █
    
    ");
}