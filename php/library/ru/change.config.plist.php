<?php

use My_bash_class\My_bash_class;


/**
 * функция проверки стокового конфиг файла на наличие основных разделов
 *
 * @param array $item_plist_xml = массив названий основных разделов
 *
 * @return null = нечего если все впорядке || ошибка и выход из программы
 */
function check_config_items($item_plist_xml = [])
{
    $arr_config_key = [
        'ACPI',
        'Boot',
        'CPU',
        'Devices',
        'GUI',
        'Graphics',
        'KernelAndKextPatches',
        'RtVariables',
        'SMBIOS',
        'SystemParameters',
    ];

    $not_found_config_key = '';
    $temp_text = '';
    $i = 0;
    foreach ($arr_config_key as $item) {
        if (array_search($item, json_decode(json_encode($item_plist_xml), true)) === false) {
            if ($i == 0) {
                $temp_text = 'отсутсвует раздел';
                $not_found_config_key .= "$item";
            } else {
                $temp_text = 'отсутсвуют разделы';
                $not_found_config_key .= ", $item";
            }
            $i++;
        }

    }
    if (!empty($not_found_config_key))
        exit_program_error("
            Ошибка!!! У вас поломанный стоковый файл config.plist
            В нем {$temp_text} ({$not_found_config_key}), попробуйте решить эту проблему после чего
            из главного меню программы вы заново можете запустить изминение стокового config.plist
            ");
    return null;
}

/**
 * функция изминения стокового config.plist
 * заменяет такие параметры как (SerialNumber|BoardSerialNumber|ROM|MLB|SmUUID)
 * параметры берутся из файла macos.hackintosh.csv лежащего в домашней папке юзера
 *
 * @return null = запускает функцию переноса измененного config.plist файла в Clover на разделе ESP
 */
function change_config_plist()
{
    $config_plist_xml = simplexml_load_file("/Volumes/EFI/EFI/CLOVER/config.plist");

    if (!$config_plist_xml)
        exit_program_error("
        Ошибка!!!
        у вас отсутствует стоковый файл config.plist в папке EFI/CLOVER
        Чтобы скрипт отработал правильно у вас должен быть стоковый config.plist в папке EFI/CLOVER
        ");

    $bash = new My_bash_class();
    $user_name_home_folder = $bash->bash('whoami');
    $bash->bash("clear");
    print_main_header();

    $csv_file = fopen("/Users/{$user_name_home_folder}/macos.hackintosh.csv", 'r');
    $my_arr_data = [];

    if (!$csv_file)
        exit_program_error("
        Ошибка!!!
        у вас отсутствует файл macos.hackintosh.csv в папке юзера по пути (/Users/{$user_name_home_folder}/)
        Чтобы скрипт отработал правильно у вас должен быть ваш личный файл macos.hackintosh.csv 
        в папке юзера по пути (/Users/{$user_name_home_folder}/)
        ");

    if ($csv_file) {
        while (($line = fgetcsv($csv_file)) !== false) {
            if ($line[0] == 'SerialNumber') {
                $my_arr_data['SerialNumber'] = strval(str_replace(' ', '', $line[1]));
            }
            if ($line[0] == 'BoardSerialNumber') {
                $my_arr_data['BoardSerialNumber'] = strval(str_replace(' ', '', $line[1]));
            }
            if ($line[0] == 'ROM') {
                $my_arr_data['ROM'] = strval(str_replace(' ', '', $line[1]));
            }
            if ($line[0] == 'SmUUID') {
                $my_arr_data['SmUUID'] = strval(str_replace(' ', '', $line[1]));
            }
        }
        fclose($csv_file);
    }

    if (count($my_arr_data) < 4)
        exit_program_error("
        Ошибка!!!
        В вашем файле macos.hackintosh.csv в папке юзера по пути (/Users/{$user_name_home_folder}/)
        Отсутствует один или несколько параметров ну или он вовсе пуст. 
        В вашем файле macos.hackintosh.csv должны содержаться данные для config.plist
        
        Пример коректного файла выглядит так:
        это рандомно сгенирированные данные от iMac18,3
        
            SerialNumber, C02ZC041J1GJ
            BoardSerialNumber, C029367004NJ0PGJA
            ROM, 4d12b4fcdb8e
            SmUUID, CAC254EB-DE42-4DC0-AAAC-ED930E22222D
        ");

    #TODO доделать проверку на коректные названия первых строк в файле macos.hackintosh.csv

    foreach ($config_plist_xml->children() as $i => $item_plist_xml) {
        if ($i == 0)
            check_config_items($item_plist_xml->key);

        foreach ($item_plist_xml->children() as $child) {
            $MLB = false;
            $ROM = false;
            $BoardSerialNumber = false;
            $SerialNumber = false;
            $SmUUID = false;

            foreach ($child as $key => $item) {
                if ($item[0] == 'MLB') {
                    $MLB = true;
                    continue;
                }
                if ($MLB) {
                    $item[0] = $my_arr_data['BoardSerialNumber'];
                    $MLB = false;
                    continue;
                }

                if ($item[0] == 'ROM') {
                    $ROM = true;
                    continue;
                }
                if ($ROM) {
                    $item[0] = hex_to_base64($my_arr_data['ROM']);
                    $ROM = false;
                    continue;
                }

                if ($item[0] == 'BoardSerialNumber') {
                    $BoardSerialNumber = true;
                    continue;
                }
                if ($BoardSerialNumber) {
                    $item[0] = $my_arr_data['BoardSerialNumber'];
                    $BoardSerialNumber = false;
                    continue;
                }

                if ($item[0] == 'SerialNumber') {
                    $SerialNumber = true;
                    continue;
                }
                if ($SerialNumber) {
                    $item[0] = $my_arr_data['SerialNumber'];
                    $SerialNumber = false;
                    continue;
                }

                if ($item[0] == 'SmUUID') {
                    $SmUUID = true;
                    continue;
                }
                if ($SmUUID) {
                    $item[0] = $my_arr_data['SmUUID'];
                    $SmUUID = false;
                    continue;
                }
            }
        }
    }

    # Сохраняю новый config.plist файл временно на ESP разделе в папке EFI
    file_put_contents("/Users/{$user_name_home_folder}/temp-file-config.plist", $config_plist_xml->saveXML());

    # Запуск функции перемещения temp-file-config.plist в /Volumes/EFI/EFI/CLOVER раздела ESP
    delivery_config("/Users/{$user_name_home_folder}/temp-file-config.plist");
}