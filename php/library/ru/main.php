<?php
/**
 * Подключение всех файлов скриптов для выполнения скрипта на русском языке
 */

include_once "print.main.title.php";                # функция которая выводит принтом главный заголовок программы

include_once "start.ru.php";                        # начальная функция запуска скрипта на русском языке

include_once "check.efi.mount.php";                 # функция проверки смонтированного EFI раздела

include_once "boot.loader.select.repo.php";         # функция выбора загрузчика для доставки на ESP раздел

include_once "change.config.plist.php";             # функция изминения файла config.plist

include_once "delivery.efi.to.esp.php";             # функция доставки EFI папки на смонтированный раздел ESP

include_once "delivery.config.to.esp.php";          # функция доставки config.plist файла