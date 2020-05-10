<?php

include_once "config.delivery.php";

use My_bash_class\My_bash_class;

function hex_to_base64($hex)
{
    $return = '';
    foreach (str_split($hex, 2) as $pair) {
        $return .= chr(hexdec($pair));
    }
    return base64_encode($return);
}

function base64_to_hex($base64)
{
    $binary = base64_decode($base64);
    return bin2hex($binary);
}

function check_config_items($item_plist_xml)
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

    foreach ($arr_config_key as $key => $item) {
        if (array_search($item, json_decode(json_encode($item_plist_xml), true)) === false)
            exit_program_error("
            Ошибка!!! У вас поломанный стоковый файл config.plist
            В нем отсутсвует раздел {$arr_config_key[$key]}
            ");
    }
    return null;
}

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
    $user = $bash->bash('whoami');
    $bash->bash("clear");
    print_main_header();

    $csv_file = fopen("/Users/{$user}/macos.hackintosh.csv", 'r');
    $my_arr_data = [];

    if (!$csv_file)
        exit_program_error("
        Ошибка!!!
        у вас отсутствует файл macos.hackintosh.csv в папке юзера по пути (/Users/{$user}/)
        Чтобы скрипт отработал правильно у вас должен быть ваш личный файл macos.hackintosh.csv 
        в папке юзера по пути (/Users/{$user}/)
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
        В вашем файле macos.hackintosh.csv в папке юзера по пути (/Users/{$user}/)
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

    file_put_contents('/Volumes/EFI/temp.plist', $config_plist_xml->saveXML());

    config_delivery();
}