<?php

use My_bash_class\My_bash_class;

/**
 * функция доставки EFI папки на смонтированный раздел ESP
 *
 * @param string $repo = ссылка на клонируемый репозиторий
 * @param bool $check = была ли проведена проверка на монтирование раздела ESP
 */
function delivery_efi($repo, $check = false)
{
    if (!$check)
        check_efi_mount(true, 'efi', $repo);
    $bash = new My_bash_class();

    print_magic_wait('ru');

    $bash->bash("rm -rf /Volumes/EFI/*");
    print_magic_wait('ru');
    $bash->bash("rm -rf /Volumes/EFI/.Trashes/*");
    print_magic_wait('ru');
    $bash->bash("git clone {$repo} /Volumes/EFI/repo-tmp");
    print_magic_wait('ru');
    $bash->bash("mv /Volumes/EFI/repo-tmp/Folder-MacOS-to-clover-partition/EFI/ /Volumes/EFI/EFI");
    print_magic_wait('ru');
    $bash->bash("rm -rf /Volumes/EFI/repo-tmp");
    # русский текст сгенирирован тут http://vkontakte.doguran.ru/kak-pisat-simvolami.php
    boot_loader_select_repo(true, "
                        ███ ███ ███   █ █ ████ ████ ███ █   █ █  █ ████    ████ ███ ████ ███ █   █ ███ █   █  ███ █  █
                        █   █    █    █ █ █  █ █  █ █   █   █ █  █ █  █    █  █ █   █  █ █   ██ ██ █   █   █  █   █  █
                        ███ ███  █    ███ █    █  █ ███ █ █ █ ████ █  █    █  █ ███ ████ ███ █ █ █ ███ █ █ █  ███ ████
                        █   █    █      █ █  █ █  █ █   █ █ █ █  █ █  █    █  █ █   █    █   █   █ █   █ █ █  █   █  █
                        ███ █   ███   ███ ████ █  █ ███ █████ █  █ ████    █  █ ███ █    ███ █   █ ███ ██████ ███ █  █
    
    ");
}