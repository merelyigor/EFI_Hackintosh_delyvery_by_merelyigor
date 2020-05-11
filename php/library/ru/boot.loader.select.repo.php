<?php

use My_bash_class\My_bash_class;

/**
 * функция выбора загрузчика для доставки на ESP раздел
 * в зависимости от выбора качает разные репозитории
 *
 * @param bool $print = вывод текстового заголовка
 */
function boot_loader_select_repo($print = true, $done = false)
{
    $repo_arr = [
        [
            'int' => '1',
            'name' => 'Asus Prime B360M-A i3-9100F RX580',
            'url' => 'git@github.com:merelyigor/Asus-Prime-B360M-A_i3-9100F_RX580.git',
        ],
        [
            'int' => '2',
            'name' => 'Asus Prime B360M-A i3-9100F RX580',
            'url' => 'git@github.com:merelyigor/Asus-Prime-B360M-A_i3-9100F_RX580.git',
        ],
    ];


    $text_header = "
    
    Выберите какой загрузчик вас интересует, чтобы выйти или запустить скрипт по изминению config.plist введите 
    соответствующий символ (+) или (-):
    
        C) Запустить изминения стокового config.plist
        B) Назад / Back <--  Выбор языка / Language selection
        Q) Выход из программы :(
    
    Список настроенных конфигураций, для запуска выберите цифру и нажмите Enter:
    
        1) {$repo_arr[0]['name']}                                             
        2) {$repo_arr[1]['name']}                                             
        
    ";

    $bash = new My_bash_class();

    if ($print) {
        $bash->bash("clear");
        print_main_header();
        $bash->EEF($text_header);
        if ($done) {
            $bash->EEF($done);
            $bash->bash("sleep 5sec");
            boot_loader_select_repo(true);
        }

    }

    $result = readline("INPUT|ВВОД: ");

    $error = error_input([
        $repo_arr[0]['int'],
        $repo_arr[1]['int'],
        'Q', 'q', 'C', 'c', 'Й', 'й', 'С', 'с', 'B', 'b', 'И', 'и', 'В', 'в',
    ], $result);

    if ($result == 'Q' || $result == 'q' || $result == 'Й' || $result == 'й')
        exit_program('Выход из программы :(');
    if ($result == 'C' || $result == 'c' || $result == 'С' || $result == 'с')
        change_config_plist();  # запуск изминения стокового config.plist
    if ($result == 'B' || $result == 'b' || $result == 'И' || $result == 'и' || $result == 'В' || $result == 'в')
        start_choice_language();  # назад к выбору языка

    if ($error) {
        $bash->bash("clear");
        print_main_header();
        $bash->EEF($text_header);
        $bash->EEF($error);
        boot_loader_select_repo(false);
    } else {
        # запуски перемещения папок EFI в ESP
        switch ($result) {
            case '1':
                delivery_efi($repo_arr[0]['url']);                  # запуск загрузки и перемещения EFI на раздел ESP
                break;
            case '2':
                delivery_efi($repo_arr[1]['url']);                  # запуск загрузки и перемещения EFI на раздел ESP
                break;
            default:
                exit_program('Черт произошла непонятная ошибка которой быть не дожно, походу ВСЕ поломалось :(');
        }
    }
}